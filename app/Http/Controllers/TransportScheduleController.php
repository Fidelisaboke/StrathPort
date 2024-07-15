<?php

namespace App\Http\Controllers;

use App\Models\TransportSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Notifications\TripCancelledNotification;
use App\Notifications\TripCompletedNotification;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

class TransportScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        $noRequestIdSchedules = TransportSchedule::whereNull('transport_request_id');

        $userRequestIdSchedulesQuery = TransportSchedule::whereHas('transportRequest', function ($query) {
            $query->where('user_id', Auth::id());
        });

        // Combine queries using unionAll (without pagination yet)
        $transportSchedules = $noRequestIdSchedules->unionAll($userRequestIdSchedulesQuery)
            ->orderBy('schedule_date', 'asc')
            ->paginate(10);

        return view('user.transport_schedules.index', compact('transportSchedules'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        $transportSchedule = TransportSchedule::find($id);
        return view('user.transport_schedules.show', compact('transportSchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');
    }
    /**
     * Search for a transport request.
     */
    public function search(Request $request)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        $search = $request->input('search');

        $noRequestIdSchedules = TransportSchedule::whereNull('transport_request_id');

        $userRequestIdSchedulesQuery = TransportSchedule::whereHas('transportRequest', function ($query) {
            $query->where('user_id', Auth::id());
        });

        // Combine queries using unionAll (without pagination yet)
        $transportSchedules = $noRequestIdSchedules->unionAll($userRequestIdSchedulesQuery)->where(function ($query) use ($search) {
            $query->where('description', 'like', '%' . $search . '%')
                ->orWhere('schedule_date', 'like', '%' . $search . '%')
                ->orWhere('schedule_time', 'like', '%' . $search . '%')
                ->orWhere('starting_point', 'like', '%' . $search . '%')
                ->orWhere('destination', 'like', '%' . $search . '%');
        })->orderBy('schedule_date', 'asc')->paginate(10);

        return view('user.transport_schedules.index', compact('transportSchedules'));
    }

    /**
     * Filter transport schedules.
     */
    public function filter(Request $request)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        $filter = $request->input('status');

        if ($filter === 'All') {

            $noRequestIdSchedules = TransportSchedule::whereNull('transport_request_id');

            $userRequestIdSchedulesQuery = TransportSchedule::whereHas('transportRequest', function ($query) {
                $query->where('user_id', Auth::id());
            });

            // Combine queries using unionAll (without pagination yet)

            $transportSchedules = $noRequestIdSchedules->unionAll($userRequestIdSchedulesQuery)->orderBy('schedule_date', 'asc')->paginate(10);
        } else {
            $noRequestIdSchedules = TransportSchedule::whereNull('transport_request_id');

            $userRequestIdSchedulesQuery = TransportSchedule::whereHas('transportRequest', function ($query) {
                $query->where('user_id', Auth::id());
            });

            // Combine queries using unionAll (without pagination yet)
            $transportSchedules = $noRequestIdSchedules->unionAll($userRequestIdSchedulesQuery)->where('status', $filter)->orderBy('schedule_date', 'asc')->paginate(10);
        }

        return view('user.transport_schedules.index', compact('transportSchedules'));
    }

    /**
     * Cancel a transport schedule.
     */
    public function cancelTrip(string $id)
    {
        abort_unless(Gate::allows('student'), 403, 'Forbidden');

        $transportSchedule = TransportSchedule::find($id);
        $transportSchedule->status = 'Cancelled';
        if ($transportSchedule->save()) {
            // Get the transport request that was used to create the transport schedule
            if ($transportSchedule->transportRequest) {
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

            if (!$transportSchedule->transportRequest) {
                // Notify all users that are students and staff
                $roles = Role::whereIn('name', ['student', 'staff'])->get();
                $users = User::role($roles, 'web')->get();
                Notification::send($users, new TripCancelledNotification($transportSchedule));

                // Notify all admins that the trip has been cancelled
                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;
                Notification::send($admins, new TripCancelledNotification($transportSchedule));
            }

            return redirect('transport_schedules')->with('success', 'Transport Schedule cancelled successfully.');
        }

        return redirect('transport_schedules')->with('error', 'Error cancelling schedule.');
    }

    /**
     * Complete a transport schedule.
     */
    public function completeTrip(string $id)
    {
        abort_unless(Gate::allows('student'), 403, 'Forbidden');

        // Check if a vehicle is assigned to the transport schedule
        $transportSchedule = TransportSchedule::find($id);

        if (is_null($transportSchedule->school_vehicle_id)) {
            return redirect()->back()->with('error', 'Vehicle has not been assigned to this schedule. It cannot be completed.');
        }

        $transportSchedule->status = 'Completed';

        if ($transportSchedule->save()) {
            // Get the transport request that was used to create the transport schedule
            if ($transportSchedule->transportRequest) {
                $transportRequest = $transportSchedule->transportRequest;

                // Get the user that made the request
                $user = $transportRequest->user;

                // Notify the user that the trip has been completed
                Notification::send($user, new TripCompletedNotification($transportSchedule));

                // Notify all admins that the trip has been completed
                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;
                Notification::send($admins, new TripCompletedNotification($transportSchedule));
            }

            if (!$transportSchedule->transportRequest) {
                // Notify all users that are students and staff
                $roles = Role::whereIn('name', ['student', 'staff'])->get();
                $users = User::role($roles, 'web')->get();
                Notification::send($users, new TripCompletedNotification($transportSchedule));

                // Notify all admins that the trip has been completed
                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;
                Notification::send($admins, new TripCompletedNotification($transportSchedule));
            }

            return redirect('transport_schedules')->with('success', 'Transport Schedule cancelled successfully.');
        }

        return redirect('transport_schedules')->with('error', 'Error cancelling schedule.');
    }
}
