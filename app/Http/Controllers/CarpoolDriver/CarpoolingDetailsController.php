<?php

namespace App\Http\Controllers\CarpoolDriver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarpoolingDetails;
use App\Models\CarpoolRequest;
use App\Models\CarpoolDriver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CarpoolTripCancelledNotification;
use App\Notifications\CarpoolTripCompletedNotification;

class CarpoolingDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        // Get carpool driver id based on user id
        $carpoolDriverId = CarpoolDriver::where('user_id', Auth::id())->pluck('id');

        // Get carpool request ids based on carpool driver id
        $carpoolRequestIds = CarpoolRequest::where('carpool_driver_id', $carpoolDriverId)->pluck('id');

        // Get carpool details based on carpool request ids
        $carpoolingDetails = CarpoolingDetails::whereIn('carpool_request_id', $carpoolRequestIds)->paginate(10);

        return view('driver.carpooling_details.index', compact('carpoolingDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        return view('driver.carpooling_details.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        $carpoolingDetail = CarpoolingDetails::find($id);
        return view('driver.carpooling_details.show', compact('carpoolingDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        $carpoolingDetail = CarpoolingDetails::find($id);
        return view('driver.carpooling_details.edit', compact('carpoolingDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        CarpoolingDetails::find($id)->delete();
        return redirect('user.carpooling_details')->with('success', 'Carpooling Detail deleted successfully.');
    }

    /**
     * Search for a carpooling detail.
     */
    public function search(Request $request)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        // Get carpool driver id based on user id
        $carpoolDriverId = CarpoolDriver::where('user_id', Auth::id())->pluck('id');

        // Get carpool request ids based on carpool driver id
        $carpoolRequestIds = CarpoolRequest::where('carpool_driver_id', $carpoolDriverId)->pluck('id');

        // Get carpool details based on search parameter and carpool request ids
        $search = $request->search;
        $carpoolingDetails = CarpoolingDetails::whereIn('carpool_request_id', $carpoolRequestIds)
            ->where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('departure_date', 'like', '%' . $search . '%')
            ->orWhere('departure_time', 'like', '%' . $search . '%')
            ->orWhere('departure_location', 'like', '%' . $search . '%')
            ->orWhere('destination', 'like', '%' . $search . '%')
            ->orWhere('no_of_people', 'like', '%' . $search . '%')
            ->paginate(10);

        return view('driver.carpooling_details.index', compact('carpoolingDetails'));
    }

    /**
     * Cancel a carpool schedule.
     */
    public function cancelTrip(string $id)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        $carpoolingDetail = CarpoolingDetails::find($id);
        $carpoolingDetail->status = 'Cancelled';
        if ($carpoolingDetail->save()) {
            $requestOwner = $carpoolingDetail->carpoolRequest->user;

            // Notify the request owner that the carpool schedule has been cancelled
            $requestOwner->notify(new CarpoolTripCancelledNotification($carpoolingDetail));

            // Notify the driver that the carpool schedule has been cancelled
            $carpoolingDetail->carpoolDriver->notify(new CarpoolTripCancelledNotification($carpoolingDetail));

            return redirect('driver/carpooling_details/' . $id)->with('success', 'Trip cancelled successfully.');
        }

        return redirect('driver/carpooling_details/' . $id)->with('error', 'Error cancelling trip.');
    }

    /**
     * Complete a carpool schedule.
     */
    public function completeTrip(string $id)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        $carpoolingDetail = CarpoolingDetails::find($id);
        $carpoolingDetail->status = 'Completed';
        if($carpoolingDetail->save()){
            $requestOwner = $carpoolingDetail->carpoolRequest->user;

            // Notify the request owner that the carpool schedule has been completed
            $requestOwner->notify(new CarpoolTripCompletedNotification($carpoolingDetail));

            // Notify the driver that the carpool schedule has been completed
            // Get the carpool driver (TODO: Check if this is the correct way to get the carpool driver)
            $carpoolDriver = Auth::user();
            Notification::send($carpoolDriver, new CarpoolTripCompletedNotification($carpoolingDetail));

            return redirect('driver/carpooling_details/' . $id)->with('success', 'Trip completed successfully.');

        }
        return redirect('driver/carpooling_details/' . $id)->with('error', 'Error completing trip.');
    }
}
