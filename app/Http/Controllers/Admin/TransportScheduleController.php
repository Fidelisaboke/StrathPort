<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TransportSchedule;
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

        $transportSchedules = TransportSchedule::orderByDesc('id')->paginate(10);
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
        ]);

        if ($validator->fails()) {
            return redirect('admin/transport_schedules/create')
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $input = [
                'school_vehicle_id' => $request->school_vehicle_id,
                'title' => $request->title,
                'description' => $request->description,
                'schedule_date' => $request->schedule_date,
                'schedule_time' => $request->schedule_time,
                'starting_point' => $request->starting_point,
                'destination' => $request->destination,
            ];

            TransportSchedule::create($input);
            return redirect('admin/transport_schedules')->with('success', 'Transport Schedule created successfully');
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
            return redirect('admin/transport_schedules/' . $id . '/edit')
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $input = [
                'school_vehicle_id' => $request->school_vehicle_id,
                'title' => $request->title,
                'description' => $request->description,
                'schedule_date' => $request->schedule_date,
                'schedule_time' => $request->schedule_time,
                'starting_point' => $request->starting_point,
                'destination' => $request->destination,
                'status' => $request->status
            ];

            TransportSchedule::find($id)->update($input);
            return redirect('admin/transport_schedules')->with('success', 'Transport Schedule updated successfully');
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
        $transportSchedules = TransportSchedule::where(function($query) use ($search){
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('schedule_date', 'like', '%' . $search . '%')
                ->orWhere('schedule_time', 'like', '%' . $search . '%')
                ->orWhere('starting_point', 'like', '%' . $search . '%')
                ->orWhere('destination', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%');
        })->paginate(10);

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

        if($transportSchedule->save()){
            // Get the transport request that was used to create the transport schedule
            if($transportSchedule->transportRequest){
                $transportRequest = $transportSchedule->transportRequest;

                // Get the user that made the request
                $user = $transportRequest->user;

                // Notify the user that the trip has been cancelled
                Notification::send($user, new TripCancelledNotification($transportSchedule));

                // Notify all admins that the trip has been cancelled
                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;
                Notification::send($admins, new TripCancelledNotification($transportSchedule));
            }

            if(!$transportSchedule->transportRequest){
                // Notify all users that are students and staff
                $roles = Role::whereIn('name', ['student', 'staff'])->get();
                $users = User::role($roles, 'web')->get();
                Notification::send($users, new TripCancelledNotification($transportSchedule));

                // Notify all admins that the trip has been cancelled
                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;
                Notification::send($admins, new TripCancelledNotification($transportSchedule));
            }

            return redirect('admin/transport_schedules')->with('success', 'Transport Schedule cancelled successfully.');
        }

        return redirect('admin/transport_schedules')->with('error', 'Error cancelling transport schedule.');
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

        if($transportSchedule->save()){
            // Get the transport request that was used to create the transport schedule
            if($transportSchedule->transportRequest){
                $transportRequest = $transportSchedule->transportRequest;

                // Get the user that made the request
                $user = $transportRequest->user;

                // Notify the user that the trip has been cancelled
                Notification::send($user, new TripCompletedNotification($transportSchedule));

                // Notify all admins that the trip has been cancelled
                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;
                Notification::send($admins, new TripCompletedNotification($transportSchedule));
            }

            if(!$transportSchedule->transportRequest){
                // Notify all users that are students and staff
                $roles = Role::whereIn('name', ['student', 'staff'])->get();
                $users = User::role($roles, 'web')->get();
                Notification::send($users, new TripCompletedNotification($transportSchedule));

                // Notify all admins that the trip has been cancelled
                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;
                Notification::send($admins, new TripCompletedNotification($transportSchedule));
            }

            return redirect('admin/transport_schedules')->with('success', 'Transport Schedule completed successfully.');
        }

        return redirect('admin/transport_schedules')->with('error', 'Error completing transport schedule.');
    }
}
