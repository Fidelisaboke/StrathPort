<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TransportSchedule;
use App\Models\SchoolVehicle;
use App\Notifications\TransportScheduleUpdatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use App\Notifications\TripCancelledNotification;
use Spatie\Permission\Models\Role;
use App\Notifications\TripCompletedNotification;
use Illuminate\Support\Facades\DB;

class TransportScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $transportSchedules = TransportSchedule::with(['transportRequest.user', 'schoolVehicle'])
            ->orderByDesc('schedule_date')
            ->paginate(10);
        return view('admin.transport_schedules.index', compact('transportSchedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        return view('admin.transport_schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $validator = Validator::make($request->all(), [
            'school_vehicle_id' => 'required|exists:school_vehicles,id',
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'schedule_date' => 'required|date|after_or_equal:today',
            'schedule_time' => 'required|after:05:00|before:19:00',
            'starting_point' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'no_of_people' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect('admin/transport_schedules/create')
                ->withErrors($validator->errors())
                ->withInput();
        }

        return DB::transaction(function () use ($request) {
            $schoolVehicle = SchoolVehicle::where('id', $request->school_vehicle_id)->lockForUpdate()->firstOrFail();

            if ($request->no_of_people > $schoolVehicle->capacity) {
                return redirect()->back()->with('error', 'Number of people exceeds selected vehicle\'s capacity.')->withInput();
            }

            if ($schoolVehicle->availability_status === 'Unavailable') {
                return redirect()->back()->with('error', 'Selected vehicle is unavailable.')->withInput();
            }

            $schoolDriver = $schoolVehicle->schoolDriver;
            if ($schoolDriver && $schoolDriver->availability_status === 'Unavailable') {
                return redirect()->back()->with('error', 'The driver of the selected vehicle is unavailable.')->withInput();
            }

            $input = $request->only(['title', 'description', 'schedule_date', 'schedule_time', 'starting_point', 'destination', 'school_vehicle_id', 'no_of_people']);

            $schoolVehicle->update(['availability_status' => 'Unavailable']);
            if ($schoolDriver) {
                $schoolDriver->update(['availability_status' => 'Unavailable']);
            }

            $transportSchedule = TransportSchedule::create($input);

            $roles = Role::whereIn('name', ['student', 'staff'])->get();
            $users = User::role($roles, 'web')->get();
            Notification::send($users, new TransportScheduleUpdatedNotification($transportSchedule));
            $admins = Role::findByName('admin', 'web')->users;
            Notification::send($admins, new TransportScheduleUpdatedNotification($transportSchedule));

            return redirect('admin/transport_schedules')->with('success', 'Transport Schedule created successfully');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $transportSchedule = TransportSchedule::find($id);
        return view('admin.transport_schedules.show', compact('transportSchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $transportSchedule = TransportSchedule::find($id);
        return view('admin.transport_schedules.edit', compact('transportSchedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $validator = Validator::make($request->all(), [
            'school_vehicle_id' => 'required|exists:school_vehicles,id',
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'schedule_date' => 'required|date|after_or_equal:today',
            'schedule_time' => 'required|after:05:00|before:19:00',
            'starting_point' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'status' => 'required|string|in:In Progress,Completed,Cancelled',
            'no_of_people' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect("admin/transport_schedules/{$id}/edit")
                ->withErrors($validator->errors())
                ->withInput();
        }

        return DB::transaction(function () use ($request, $id) {
            $transportSchedule = TransportSchedule::findOrFail($id);
            $newVehicle = SchoolVehicle::where('id', $request->school_vehicle_id)->lockForUpdate()->firstOrFail();

            if ($request->no_of_people > $newVehicle->capacity) {
                return redirect()->back()->with('error', 'Number of people exceeds selected vehicle capacity.')->withInput();
            }

            // Handle vehicle change
            if ($transportSchedule->school_vehicle_id != $request->school_vehicle_id) {
                $oldVehicle = SchoolVehicle::where('id', $transportSchedule->school_vehicle_id)->lockForUpdate()->first();
                if ($oldVehicle) {
                    $oldVehicle->update(['availability_status' => 'Available']);
                }
                $newVehicle->update(['availability_status' => 'Unavailable']);
            }

            $input = $request->only(['title', 'description', 'schedule_date', 'schedule_time', 'starting_point', 'destination', 'status', 'school_vehicle_id', 'no_of_people']);

            // Handle status transitions
            if (in_array($request->status, ['Cancelled', 'Completed'])) {
                $newVehicle->update(['availability_status' => 'Available']);
                if ($newVehicle->schoolDriver) {
                    $newVehicle->schoolDriver()->update(['availability_status' => 'Available']);
                }
            } else {
                $newVehicle->update(['availability_status' => 'Unavailable']);
                if ($newVehicle->schoolDriver) {
                    $newVehicle->schoolDriver()->update(['availability_status' => 'Unavailable']);
                }
            }

            $transportSchedule->update($input);

            // Notifications
            $users = collect();
            if ($transportSchedule->transportRequest) {
                $users->push($transportSchedule->transportRequest->user);
            } else {
                $roles = Role::whereIn('name', ['student', 'staff'])->get();
                $users = User::role($roles, 'web')->get();
            }

            Notification::send($users, new TransportScheduleUpdatedNotification($transportSchedule));
            $admins = Role::findByName('admin', 'web')->users;
            Notification::send($admins, new TransportScheduleUpdatedNotification($transportSchedule));

            return redirect('admin/transport_schedules')->with('success', 'Transport Schedule updated successfully.');
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');
    }

    /**
     * Search for transport schedules.
     */
    public function search(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $search = $request->search;
        $transportSchedules = TransportSchedule::with(['transportRequest.user', 'schoolVehicle'])
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('schedule_date', 'like', '%' . $search . '%')
                    ->orWhere('schedule_time', 'like', '%' . $search . '%')
                    ->orWhere('starting_point', 'like', '%' . $search . '%')
                    ->orWhere('destination', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            })
            ->orderByDesc('schedule_date')
            ->paginate(10);

        return view('admin.transport_schedules.index', compact('transportSchedules'));
    }

    /**
     * Filter transport schedules.
     */
    public function filter(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $filter = $request->input('status');

        $query = TransportSchedule::with(['transportRequest.user', 'schoolVehicle']);

        if ($filter !== 'All') {
            $query->where('status', $filter);
        }

        $transportSchedules = $query->orderByDesc('schedule_date')->paginate(10);

        return view('admin.transport_schedules.index', compact('transportSchedules'));
    }

    /**
     * Cancel a transport schedule.
     */
    public function cancelTrip(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        return DB::transaction(function () use ($id) {
            $transportSchedule = TransportSchedule::findOrFail($id);
            $transportSchedule->update(['status' => 'Cancelled']);

            if ($transportSchedule->school_vehicle_id) {
                $schoolVehicle = SchoolVehicle::where('id', $transportSchedule->school_vehicle_id)->lockForUpdate()->first();
                if ($schoolVehicle) {
                    $schoolVehicle->update(['availability_status' => 'Available']);
                    if ($schoolVehicle->schoolDriver) {
                        $schoolVehicle->schoolDriver()->update(['availability_status' => 'Available']);
                    }
                }
            }

            $users = collect();
            if ($transportSchedule->transportRequest) {
                $users->push($transportSchedule->transportRequest->user);
            } else {
                $roles = Role::whereIn('name', ['student', 'staff'])->get();
                $users = User::role($roles, 'web')->get();
            }

            Notification::send($users, new TripCancelledNotification($transportSchedule));
            $admins = Role::findByName('admin', 'web')->users;
            Notification::send($admins, new TripCancelledNotification($transportSchedule));

            return redirect('admin/transport_schedules')->with('success', 'Transport Schedule cancelled successfully.');
        });
    }

    /**
     * Complete a transport schedule.
     */
    public function completeTrip(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        return DB::transaction(function () use ($id) {
            $transportSchedule = TransportSchedule::findOrFail($id);

            if (is_null($transportSchedule->school_vehicle_id)) {
                return redirect()->back()->with('error', 'Vehicle has not been assigned to this schedule. It cannot be completed.');
            }

            $transportSchedule->update(['status' => 'Completed']);

            $schoolVehicle = SchoolVehicle::where('id', $transportSchedule->school_vehicle_id)->lockForUpdate()->first();
            if ($schoolVehicle) {
                $schoolVehicle->update(['availability_status' => 'Available']);
                if ($schoolVehicle->schoolDriver) {
                    $schoolVehicle->schoolDriver()->update(['availability_status' => 'Available']);
                }
            }

            $users = collect();
            if ($transportSchedule->transportRequest) {
                $users->push($transportSchedule->transportRequest->user);
            } else {
                $roles = Role::whereIn('name', ['student', 'staff'])->get();
                $users = User::role($roles, 'web')->get();
            }

            Notification::send($users, new TripCompletedNotification($transportSchedule));
            $admins = Role::findByName('admin', 'web')->users;
            Notification::send($admins, new TripCompletedNotification($transportSchedule));

            return redirect('admin/transport_schedules')->with('success', 'Transport Schedule completed successfully.');
        });
    }
}
