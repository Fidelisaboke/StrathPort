<?php

namespace App\Http\Controllers\CarpoolDriver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarpoolDriver;
use App\Models\CarpoolRequest;
use App\Models\CarpoolingDetails;
use App\Models\CarpoolVehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CarpoolRequestApprovedNotification;
use App\Notifications\CarpoolRequestDeclinedNotification;

class CarpoolRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        $carpoolDriverId = CarpoolDriver::where('user_id', Auth::id())->pluck('id');
        $carpoolRequests = CarpoolRequest::where('carpool_driver_id', $carpoolDriverId)->orderByDesc('id')->paginate(10);

        return view('driver.carpool_requests.index', compact('carpoolRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');
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

        $carpoolRequest = CarpoolRequest::find($id);
        return view('driver.carpool_requests.show', compact('carpoolRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');
    }

    /**
     * Update the specified resource in storage.
     * In this case, the driver can approve or decline a carpool request.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        if (CarpoolDriver::doesntHave('carpoolVehicle')->where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('error', 'You need to add a vehicle before you can approve a carpool request.');
        }

        $carpoolRequest = CarpoolRequest::find($id);

        //Vadidate the request
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Approved,Declined'
        ]);

        if ($validator->fails()) {
            return redirect('driver/carpool_requests/' . $id)
                ->withErrors($validator->errors())
                ->withInput();
        }

        $carpoolRequest->status = $request->status;

        $carpoolSchedule = CarpoolingDetails::where('carpool_request_id', $id)->first();

        // Check if the carpool request is approved and a carpool schedule has not been created
        if ($request->status == 'Approved' && empty($carpoolSchedule)) {
            // Check if the carpool driver has a vehicle or driver is unavailable
            $carpoolDriverId = CarpoolDriver::where('user_id', Auth::id())->pluck('id')->first();
            $carpoolVehicle = CarpoolVehicle::where('carpool_driver_id', $carpoolDriverId)->first();
            $driverAvailability = CarpoolDriver::where('user_id', Auth::id())->pluck('availability_status')->first();

            if (empty($carpoolVehicle)) {
                return redirect()->back()->with('error', 'You need to add a vehicle before you can approve a carpool request.');
            }

            if ($driverAvailability == 'Unavailable') {
                return redirect()->back()->with('error', 'You are currently unavailable. Change your availability status before you can approve a carpool request.');
            }

            // Check if a driver has at least one carpool schedule in progress
            $pendingCarpoolSchedules = CarpoolingDetails::whereHas('carpoolRequest', function ($query) use ($carpoolDriverId) {
                $query->where('carpool_driver_id', $carpoolDriverId);
            })->where('status', 'In Progress')->count();
            if ($pendingCarpoolSchedules > 0) {
                return redirect()->back()->with('error', 'You have a carpool schedule in progress. Complete the schedule before you can approve another carpool request.');
            }

            // Create a carpool schedule
            $carpoolSchedule = new CarpoolingDetails();
            $carpoolSchedule->carpool_request_id = $id;
            $scheduleCreated = $carpoolSchedule->save();

            if (!$scheduleCreated) {
                return redirect('driver/carpool_requests/' . $id)->with('error', 'Failed to create carpool schedule.');
            }

            // Save the status
            $statusSaved = $carpoolRequest->save();

            if (!$statusSaved) {
                return redirect('driver/carpool_requests/' . $id)->with('error', 'Failed to update carpool request status.');
            }

            // Notify the carpool request owner
            $requestOwner = $carpoolRequest->user;
            Notification::send($requestOwner, new CarpoolRequestApprovedNotification($carpoolRequest));

            // Notify the carpool driver and update the availability status
            $carpoolDriver = CarpoolDriver::find($carpoolRequest->carpool_driver_id);
            Notification::send($carpoolDriver->user, new CarpoolRequestApprovedNotification($carpoolRequest));
            $carpoolDriver->availability_status = 'Unavailable';
            if (!$carpoolDriver->save()) {
                return redirect('driver/carpool_requests/' . $id)->with('error', 'Failed to update carpool driver availability status.');
            }

            return redirect('driver/carpool_requests/' . $id)->with('success', 'Carpool request approved successfully.');
        }

        // Check if the carpool request is declined and a carpool schedule is not null
        if ($request->status == 'Declined') {

            // Save the status
            $statusSaved = $carpoolRequest->save();

            if (!$statusSaved) {
                return redirect('driver/carpool_requests/' . $id)->with('error', 'Failed to update carpool request status.');
            }

            $requestOwner = $carpoolRequest->user;
            Notification::send($requestOwner, new CarpoolRequestDeclinedNotification($carpoolRequest));

            $carpoolDriver = CarpoolDriver::find($carpoolRequest->carpool_driver_id);
            Notification::send($carpoolDriver->user, new CarpoolRequestDeclinedNotification($carpoolRequest));

            return redirect('driver/carpool_requests/' . $id)->with('success', 'Carpool request declined successfully.');
        }

        // Save the status
        $statusSaved = $carpoolRequest->save();

        if (!$statusSaved) {
            return redirect()->back()->with('error', 'Failed to update carpool request status.');
        }

        return redirect('driver/carpool_requests/' . $id)->with('success', 'Carpool request status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');
    }

    /**
     * Search for a carpool request.
     */
    public function search(Request $request)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        $search = $request->get('search');

        $carpoolDriverId = CarpoolDriver::where('user_id', Auth::id())->pluck('id');
        $carpoolRequests = CarpoolRequest::where('carpool_driver_id', $carpoolDriverId)
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('departure_location', 'like', '%' . $search . '%')
                    ->orWhere('destination', 'like', '%' . $search . '%');
            })
            ->paginate(10);
        return view('driver.carpool_requests.index', compact('carpoolRequests'));
    }

    /**
     * Filter carpool requests by status.
     */
    public function filter(Request $request)

    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        $filter = $request->get('status');
        $carpoolDriverId = CarpoolDriver::where('user_id', Auth::id())->pluck('id');

        if ($filter == 'All') {
            $carpoolRequests = CarpoolRequest::where('carpool_driver_id', $carpoolDriverId)->orderByDesc('id')->paginate(10);
        } else {
            $carpoolRequests = CarpoolRequest::where('carpool_driver_id', $carpoolDriverId)
                ->where('status', $filter)
                ->orderByDesc('id')
                ->paginate(10);
        }

        return view('driver.carpool_requests.index', compact('carpoolRequests'));
    }
}
