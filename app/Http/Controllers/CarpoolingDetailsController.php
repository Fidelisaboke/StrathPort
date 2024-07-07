<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarpoolingDetails;
use App\Models\CarpoolRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CarpoolingDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        // Get carpool request ids based on user id
        $carpoolRequestIds = CarpoolRequest::where('user_id', Auth::id())->get('id');

        // Get carpool details based on carpool request ids
        $carpoolingDetails = CarpoolingDetails::whereIn('carpool_request_id', $carpoolRequestIds)->paginate(10);

        return view('user.carpooling_details.index', compact('carpoolingDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        return view('user.carpooling_details.create');
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

        $carpoolingDetail = CarpoolingDetails::find($id);
        return view('user.carpooling_details.show', compact('carpoolingDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        $carpoolingDetail = CarpoolingDetails::find($id);
        return view('user.carpooling_details.edit', compact('carpoolingDetail'));
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

        CarpoolingDetails::find($id)->delete();
        return redirect('user.carpooling_details')->with('success', 'Carpooling Detail deleted successfully.');
    }

    /**
     * Search for a carpooling detail.
     */
    public function search(Request $request)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        $search = $request->input('search');

        // Search for carpooling details for the user based on carpool request details of the user
        $carpoolRequestIds = CarpoolRequest::where('user_id', Auth::id())->get('id');
        $carpoolingDetails = CarpoolingDetails::whereIn('carpool_request_id', $carpoolRequestIds)
            ->where('title', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->orWhere('carpool_driver_id', 'like', "%$search%")
            ->orWhere('departure_date', 'like', "%$search%")
            ->orWhere('departure_time', 'like', "%$search%")
            ->orWhere('departure_location', 'like', "%$search%")
            ->orWhere('destination', 'like', "%$search%")
            ->orWhere('no_of_people', 'like', "%$search%")
            ->paginate(10);

        return view('user.carpooling_details.index', compact('carpoolingDetails'));
    }

    /**
     * Cancel a carpool schedule.
     */
    public function cancelTrip(string $id)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        $carpoolingDetail = CarpoolingDetails::find($id);
        $carpoolingDetail->status = 'Cancelled';
        $carpoolingDetail->save();

        return redirect('driver.carpooling_details')->with('success', 'Carpooling Detail cancelled successfully.');
    }

    /**
     * Complete a carpool schedule.
     */
    public function completeTrip(string $id)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        $carpoolingDetail = CarpoolingDetails::find($id);
        $carpoolingDetail->status = 'Completed';
        $carpoolingDetail->save();

        return redirect('driver.carpooling_details')->with('success', 'Carpooling Detail completed successfully.');
    }
}
