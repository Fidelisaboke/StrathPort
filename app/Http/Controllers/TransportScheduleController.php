<?php

namespace App\Http\Controllers;
use App\Models\TransportSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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

        $userRequestIdSchedulesQuery = TransportSchedule::whereHas('transportRequest', function($query) {
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

        $userRequestIdSchedulesQuery = TransportSchedule::whereHas('transportRequest', function($query) {
            $query->where('user_id', Auth::id());
        });

        // Combine queries using unionAll (without pagination yet)
        $transportSchedules = $noRequestIdSchedules->unionAll($userRequestIdSchedulesQuery)->where(function($query) use ($search){
            $query->where('description', 'like', '%' . $search . '%')
            ->orWhere('schedule_date', 'like', '%' . $search . '%')
            ->orWhere('schedule_time', 'like', '%' . $search . '%')
            ->orWhere('starting_point', 'like', '%' . $search . '%')
            ->orWhere('destination', 'like', '%' . $search . '%');
        })->paginate(10);

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
        $transportSchedule->save();

        return redirect('transport_schedules')->with('success', 'Transport Schedule cancelled successfully.');
    }

    /**
     * Complete a transport schedule.
     */
    public function completeTrip(string $id)
    {
        abort_unless(Gate::allows('student'), 403, 'Forbidden');

        $transportSchedule = TransportSchedule::find($id);
        $transportSchedule->status = 'Completed';
        $transportSchedule->save();

        return redirect('transport_schedules')->with('success', 'Transport Schedule completed successfully.');
    }
}
