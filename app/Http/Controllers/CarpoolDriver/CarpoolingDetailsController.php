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
            ->where(function ($query) use ($search) {
                $query->whereHas('carpoolRequest', function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhere('departure_date', 'like', '%' . $search . '%')
                        ->orWhere('departure_time', 'like', '%' . $search . '%')
                        ->orWhere('departure_location', 'like', '%' . $search . '%')
                        ->orWhere('destination', 'like', '%' . $search . '%')
                        ->orWhere('no_of_people', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                });
            })
            ->paginate(10);

        return view('driver.carpooling_details.index', compact('carpoolingDetails'));
    }

    /**
     * Filter carpooling details.
     */
    public function filter(Request $request)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        $status = $request->status;
        if ($status === 'All') {
            // Get all carpooling details belonging to the carpool driver
            $carpoolDriverId = CarpoolDriver::where('user_id', Auth::id())->pluck('id');
            $carpoolRequestIds = CarpoolRequest::where('carpool_driver_id', $carpoolDriverId)->pluck('id');
            $carpoolingDetails = CarpoolingDetails::whereIn('carpool_request_id', $carpoolRequestIds)->paginate(10);
        } else {
            // Get carpool driver id based on user id
            $carpoolDriverId = CarpoolDriver::where('user_id', Auth::id())->pluck('id');

            // Get carpool request ids based on carpool driver id
            $carpoolRequestIds = CarpoolRequest::where('carpool_driver_id', $carpoolDriverId)->pluck('id');

            // Get carpool details based on filter parameters and carpool request ids
            $departureDate = $request->departure_date;
            $departureLocation = $request->departure_location;
            $destination = $request->destination;

            $carpoolingDetails = CarpoolingDetails::whereIn('carpool_request_id', $carpoolRequestIds)
                ->where('status', 'like', '%' . $status . '%')
                ->paginate(10);
        }

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
            $carpoolDriver = $carpoolingDetail->carpoolRequest->carpoolDriver;

            Notification::send([$requestOwner, $carpoolDriver->user], new CarpoolTripCancelledNotification($carpoolingDetail));

            // Make carpool driver available
            $carpoolDriver->availability_status = 'Available';
            if (!$carpoolDriver->save()) {
                return redirect('driver/carpooling_details/' . $id)->with('error', 'Error updating carpool driver availability status. Trip cancelled.');
            }

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
        if ($carpoolingDetail->save()) {
            $requestOwner = $carpoolingDetail->carpoolRequest->user;

            $requestOwner->notify(new CarpoolTripCompletedNotification($carpoolingDetail));

            $carpoolDriver = CarpoolDriver::find($carpoolingDetail->carpoolRequest->carpool_driver_id);

            $carpoolDriver->user->notify(new CarpoolTripCompletedNotification($carpoolingDetail));

            // Make carpool driver available
            $carpoolDriver->availability_status = 'Available';
            if (!$carpoolDriver->save()) {
                return redirect('driver/carpooling_details/' . $id)->with('error', 'Error updating carpool driver availability status. Trip completed.');
            }

            return redirect('driver/carpooling_details/' . $id)->with('success', 'Trip completed successfully.');
        }
        return redirect('driver/carpooling_details/' . $id)->with('error', 'Error completing trip.');
    }
}
