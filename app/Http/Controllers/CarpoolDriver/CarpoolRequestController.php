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

class CarpoolRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get carpool driver id based on user id
        $carpoolDriverId = CarpoolDriver::where('user_id', Auth::id())->pluck('id');

        // Get carpool requests based on carpool driver id
        $carpoolRequests = CarpoolRequest::where('carpool_driver_id', $carpoolDriverId)->orderByDesc('id')->paginate(10);

        return view('driver.carpool_requests.index', compact('carpoolRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $carpoolRequest = CarpoolRequest::find($id);
        return view('driver.carpool_requests.show', compact('carpoolRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }

    /**
     * Search for a carpool request.
     */
    public function search(Request $request){
        $search = $request->get('search');
        $carpoolRequests = CarpoolRequest::where('title', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')
            ->orWhere('departure_location', 'like', '%'.$search.'%')
            ->orWhere('destination', 'like', '%'.$search.'%')
            ->paginate(10);
        return view('driver.carpool_requests.index', compact('carpoolRequests'));
    }

    /**
     * Filter carpool requests by status.
     */
    public function filter(Request $request){
        $filter = $request->get('status');
        if($filter == 'All'){
           $carpoolRequests = CarpoolRequest::paginate(10);
        }else{
            $carpoolRequests = CarpoolRequest::where('status', $filter)->paginate(10);
        }

        return view('driver.carpool_requests.index', compact('carpoolRequests'));
    }

    /**
     * Update the status of a carpool request.
     */
    public function updateStatus(Request $request, string $id){
        $carpoolRequest = CarpoolRequest::find($id);

        //Vadidate the request
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Approved,Declined'
        ]);

        if($validator->fails()){
            return redirect('driver/carpool_requests/'.$id)
                ->withErrors($validator->errors())
                ->withInput();
        }

        $carpoolRequest->status = $request->status;

        $carpoolSchedule = CarpoolingDetails::where('carpool_request_id', $id)->first();

        // Check if the carpool request is approved and a carpool schedule has not been created
        if($request->status == 'Approved' && empty($carpoolSchedule)){
            // Check if the carpool driver has a vehicle or driver is unavailable
            $carpoolDriverId = CarpoolDriver::where('user_id', Auth::id())->pluck('id')->first();
            $carpoolVehicle = CarpoolVehicle::where('carpool_driver_id', $carpoolDriverId)->first();
            $driverAvailability = CarpoolDriver::where('user_id', Auth::id())->pluck('availability_status')->first();

            if(empty($carpoolVehicle)){
                return redirect()->back()->with('error', 'You need to add a vehicle before you can approve a carpool request.');
            }

            if($driverAvailability == 'Unavailable'){
                return redirect()->back()->with('error', 'You are currently unavailable. Change your availability status before you can approve a carpool request.');
            }

            // Create a carpool schedule
            $carpoolSchedule = new CarpoolingDetails();
            $carpoolSchedule->carpool_request_id = $id;
            $scheduleCreated = $carpoolSchedule->save();

            if(!$scheduleCreated){
                return redirect('driver/carpool_requests/'.$id)->with('error', 'Failed to create carpool schedule.');
            }

            // Save the status
            $statusSaved = $carpoolRequest->save();

            if(!$statusSaved){
                return redirect('driver/carpool_requests/'.$id)->with('error', 'Failed to update carpool request status.');
            }

            return redirect('driver/carpool_requests/'.$id)->with('success', 'Carpool request approved successfully.');
        }

        // Check if the carpool request is declined and a carpool schedule is not null
        if($request->status == 'Declined' && $carpoolSchedule != null){
            // Delete the carpool schedule
            $scheduleDeleted = $carpoolSchedule->delete();

            if(!$scheduleDeleted){
                return redirect('driver/carpool_requests/'.$id)->with('error', 'Failed to delete carpool schedule.');
            }

            // Save the status
            $statusSaved = $carpoolRequest->save();

            if(!$statusSaved){
                return redirect('driver/carpool_requests/'.$id)->with('error', 'Failed to update carpool request status.');
            }

            return redirect('driver/carpool_requests/'.$id)->with('success', 'Carpool request declined successfully.');
        }

        // Save the status
        $statusSaved = $carpoolRequest->save();

        if(!$statusSaved){
            return redirect()->back()->with('error', 'Failed to update carpool request status.');
        }

        return redirect('driver/carpool_requests/'.$id)->with('success', 'Carpool request status updated successfully.');
    }

}
