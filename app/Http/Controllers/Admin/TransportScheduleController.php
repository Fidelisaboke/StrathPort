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

class TransportScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $transportSchedules = TransportSchedule::orderByDesc('schedule_date')->paginate(10);
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

        //Validate the request...
        $validator = Validator::make($request->all(), [
            'school_vehicle_id' => 'required|exists:school_vehicles,id',
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'schedule_date' => 'required|date|before:2024-12-31|after_or_equal:today',
            'schedule_time' => 'required|after:05:00|before:19:00',
            'starting_point' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'no_of_people' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect('admin/transport_schedules/create')
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $input = [
                'title' => $request->title,
                'description' => $request->description,
                'schedule_date' => $request->schedule_date,
                'schedule_time' => $request->schedule_time,
                'starting_point' => $request->starting_point,
                'destination' => $request->destination,
            ];

            $schoolVehicle = SchoolVehicle::find($request->school_vehicle_id);

            // Check if the number of people is greater than the school vehicle capacity
            if ($request->no_of_people > $schoolVehicle->capacity) {
                return redirect()->back()
                    ->with('error', 'Number of people exceeds selected vehicle\'s capacity.')
                    ->withInput();
            }

            $input['school_vehicle_id'] = $request->school_vehicle_id;
            $input['no_of_people'] = $request->no_of_people;

            // Prevent the creation of a transport schedule if the school vehicle is unavailable
            if ($schoolVehicle->availability_status === 'Unavailable') {
                return redirect()->back()
                    ->with('error', 'Selected vehicle is unavailable.')
                    ->withInput();
            }

            // Prevent the creation of a transport schedule if the school driver is unavailable
            if ($schoolVehicle->schoolDriver->availability_status === 'Unavailable') {
                return redirect()->back()
                    ->with('error', 'The driver of the selected vehicle is unavailable.')
                    ->withInput();
            }


            // Update the availability of the school vehicle
            $schoolVehicle->availability_status = 'Unavailable';
            if (!$schoolVehicle->save()) {
                return redirect()->back()
                    ->with('error', 'Failed to update availability status of school vehicle.')
                    ->withInput();
            }

            // Update driver availability status
            $schoolDriver = $schoolVehicle->schoolDriver;
            $schoolDriver->availability_status = 'Unavailable';
            if (!$schoolDriver->save()) {
                return redirect()->back()
                    ->with('error', 'Failed to update availability status of school driver.')
                    ->withInput();
            }

            $transportSchedule = TransportSchedule::create($input);

            if ($transportSchedule) {
                $roles = Role::whereIn('name', ['student', 'staff'])->get();
                $users = User::role($roles, 'web')->get();

                // Notify the users that the trip has been scheduled
                Notification::send($users, new TransportScheduleUpdatedNotification($transportSchedule));

                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;

                // Notify the admins that the trip has been scheduled
                Notification::send($admins, new TransportScheduleUpdatedNotification($transportSchedule));

                return redirect('admin/transport_schedules')->with('success', 'Transport Schedule created successfully');
            }


            return redirect()->back()
                ->with('error', 'Failed to update transport schedule')
                ->withInput();
        }
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

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'school_vehicle_id' => 'required|exists:school_vehicles,id',
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'schedule_date' => 'required|date|before:2024-12-31|after_or_equal:today',
            'schedule_time' => 'required|after:05:00|before:19:00',
            'starting_point' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'status' => 'required|string|in:In Progress,Completed,Cancelled'
        ]);

        if ($validator->fails()) {
            return redirect("admin/transport_schedules/{$id}/edit")
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $input = [
                'title' => $request->title,
                'description' => $request->description,
                'schedule_date' => $request->schedule_date,
                'schedule_time' => $request->schedule_time,
                'starting_point' => $request->starting_point,
                'destination' => $request->destination,
                'status' => $request->status
            ];

            $schoolVehicle = SchoolVehicle::find($request->school_vehicle_id);

            // Check if the number of people is greater than the school vehicle capacity
            if ($request->no_of_people > $schoolVehicle->capacity) {
                return redirect()->back()
                    ->with('error', 'Number of people exceeds selected vehicle capacity.')
                    ->withInput();
            }

            $input['school_vehicle_id'] = $request->school_vehicle_id;
            $input['no_of_people'] = $request->no_of_people;

            $transportSchedule = TransportSchedule::find($id);

            if ($transportSchedule->school_vehicle_id == null) {
                $input['school_vehicle_id'] = $request->school_vehicle_id;
                $transportSchedule->school_vehicle_id = $request->school_vehicle_id;
            }

            // Check if the school vehicle has been changed
            if ($transportSchedule->school_vehicle_id != $request->school_vehicle_id) {

                // Update the availibility of the previous school vehicle
                $previousSchoolVehicle = SchoolVehicle::find($transportSchedule->school_vehicle_id);

                if (!empty($previousSchoolVehicle)) {
                    $previousSchoolVehicle->availability_status = 'Available';
                    if (!$previousSchoolVehicle->save()) {
                        return redirect()->back()
                            ->with('error', 'Failed to update availability status of previous school vehicle.')
                            ->withInput();
                    }
                }
            }

            // Update the availability of the new school vehicle
            $schoolVehicle->availability_status = 'Unavailable';
            if (!$schoolVehicle->save()) {
                return redirect()->back()
                    ->with('error', 'Failed to update availability status of newly allocated school vehicle.')
                    ->withInput();
            }

            // Check for transport schedule status
            if ($input['status'] === 'Cancelled' || $input['status'] === 'Completed') {
                // Make both the vehicle and the driver available
                $schoolVehicle->availability_status = 'Available';
                $schoolVehicle->save();

                $schoolDriver = $schoolVehicle->schoolDriver;
                $schoolDriver->availability_status = 'Available';
                $schoolDriver->save();
            } else {
                // Update driver availability status
                $schoolDriver = $schoolVehicle->schoolDriver;
                $schoolDriver->availability_status = 'Unavailable';
                $schoolDriver->save();
            }

            if ($transportSchedule->update($input)) {

                // Get the transport request that was used to create the transport schedule
                if ($transportSchedule->transportRequest) {
                    $transportRequest = $transportSchedule->transportRequest;

                    $user = $transportRequest->user;

                    // Notify the user that the trip has been cancelled
                    Notification::send($user, new TransportScheduleUpdatedNotification($transportSchedule));

                    $adminRole = Role::findByName('admin', 'web');
                    $admins = $adminRole->users;

                    // Notify the admins that the trip has been cancelled
                    Notification::send($admins, new TransportScheduleUpdatedNotification($transportSchedule));
                } else {
                    $roles = Role::whereIn('name', ['student', 'staff'])->get();
                    $users = User::role($roles, 'web')->get();

                    // Notify the users that the trip has been cancelled
                    Notification::send($users, new TransportScheduleUpdatedNotification($transportSchedule));

                    $adminRole = Role::findByName('admin', 'web');
                    $admins = $adminRole->users;

                    // Notify the admins that the trip has been cancelled
                    Notification::send($admins, new TransportScheduleUpdatedNotification($transportSchedule));
                }

                return redirect('admin/transport_schedules')->with('success', 'Transport Schedule updated successfully.');
            }

            return redirect()->back()
                ->with('error', 'Failed to update transport schedule.')
                ->withInput();
        }
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
        $transportSchedules = TransportSchedule::where(function ($query) use ($search) {
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
     * Cancel a transport schedule.
     */
    public function cancelTrip(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $transportSchedule = TransportSchedule::find($id);
        $transportSchedule->status = 'Cancelled';

        if ($transportSchedule->save()) {

            // Update the availability of the school vehicle
            $schoolVehicle = SchoolVehicle::find($transportSchedule->school_vehicle_id);
            $schoolVehicle->availability_status = 'Available';

            // Update driver availability status
            $schoolDriver = $schoolVehicle->schoolDriver;
            $schoolDriver->availability_status = 'Available';

            if (!$schoolVehicle->save() || !$schoolDriver->save()) {
                return redirect()->back()->with('error', 'Failed to update availability status of school vehicle.');
            }

            // Get the transport request that was used to create the transport schedule
            if ($transportSchedule->transportRequest) {
                $transportRequest = $transportSchedule->transportRequest;

                $user = $transportRequest->user;

                // Notify the user that the trip has been cancelled
                Notification::send($user, new TripCancelledNotification($transportSchedule));

                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;

                // Notify the admins that the trip has been cancelled
                Notification::send($admins, new TripCancelledNotification($transportSchedule));
            } else {
                $roles = Role::whereIn('name', ['student', 'staff'])->get();
                $users = User::role($roles, 'web')->get();

                // Notify the users that the trip has been cancelled
                Notification::send($users, new TripCancelledNotification($transportSchedule));

                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;

                // Notify the admins that the trip has been cancelled
                Notification::send($admins, new TripCancelledNotification($transportSchedule));
            }

            return redirect('admin/transport_schedules')->with('success', 'Transport Schedule cancelled successfully.');
        }

        return redirect()->back()->with('error', 'Error cancelling transport schedule.');
    }

    /**
     * Complete a transport schedule.
     */
    public function completeTrip(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        // Check if a vehicle is assigned to the transport schedule
        $transportSchedule = TransportSchedule::find($id);

        if (is_null($transportSchedule->school_vehicle_id)) {
            return redirect()->back()->with('error', 'Vehicle has not been assigned to this schedule. It cannot be completed.');
        }

        $transportSchedule->status = 'Completed';

        if ($transportSchedule->save()) {
            // Update the availability of the school vehicle
            $schoolVehicle = SchoolVehicle::find($transportSchedule->school_vehicle_id);
            $schoolVehicle->availability_status = 'Available';

            // Update driver availability status
            $schoolDriver = $schoolVehicle->schoolDriver;
            $schoolDriver->availability_status = 'Available';

            if (!$schoolVehicle->save() || !$schoolDriver->save()) {
                return redirect()->back()->with('error', 'Failed to update availability status of school vehicle.');
            }

            // Get the transport request that was used to create the transport schedule
            if ($transportSchedule->transportRequest) {
                $transportRequest = $transportSchedule->transportRequest;

                $user = $transportRequest->user;

                // Notify the user that the trip has been completed
                Notification::send($user, new TripCompletedNotification($transportSchedule));

                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;

                // Notify the admins that the trip has been completed
                Notification::send($admins, new TripCompletedNotification($transportSchedule));
            } else {
                $roles = Role::whereIn('name', ['student', 'staff'])->get();
                $users = User::role($roles, 'web')->get();

                // Notify the users that the trip has been completed
                Notification::send($users, new TripCompletedNotification($transportSchedule));

                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;

                // Notify the admins that the trip has been completed
                Notification::send($admins, new TripCompletedNotification($transportSchedule));
            }

            return redirect('admin/transport_schedules')->with('success', 'Transport Schedule completed successfully.');
        }

        return redirect()->back()->with('error', 'Error completing transport schedule.');
    }
}
