<?php

namespace App\Http\Controllers;
use App\Models\TransportSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TransportScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $noRequestIdSchedules = TransportSchedule::whereNull('transport_request_id');

        $userRequestIdSchedulesQuery = TransportSchedule::whereHas('transportRequest', function($query) {
            $query->where('user_id', Auth::id());
        });

        // Combine queries using unionAll (without pagination yet)
        $allSchedulesQuery = $noRequestIdSchedules->unionAll($userRequestIdSchedulesQuery);

        // Apply pagination on the combined query
        $transportSchedules = $allSchedulesQuery->paginate(10);

        return view('user.transport_schedules.index', compact('transportSchedules'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transportSchedule = TransportSchedule::find($id);
        return view('user.transport_schedules.show', compact('transportSchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    /**
     * Search for a transport request.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $transportSchedules = TransportSchedule::where(function($query) use ($search){
            $query->where('description', 'like', '%' . $search . '%')
            ->orWhere('schedule_date', 'like', '%' . $search . '%')
            ->orWhere('schedule_time', 'like', '%' . $search . '%')
            ->orWhere('starting_point', 'like', '%' . $search . '%')
            ->orWhere('destination', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('user.transport_schedules.index', compact('transportSchedules'));
    }
}
