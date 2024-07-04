<?php

namespace App\Http\Controllers\CarpoolDriver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarpoolDriver;
use App\Models\CarpoolRequest;
use Illuminate\Support\Facades\Auth;

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
        $carpoolRequests = CarpoolRequest::where('carpool_driver_id', $carpoolDriverId)->paginate(10);
        
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
}
