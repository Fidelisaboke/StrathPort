<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarpoolingDetails;
use App\Models\CarpoolRequest;
use Illuminate\Support\Facades\Auth;

class CarpoolingDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        return view('user.carpooling_details.create');
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
        $carpoolingDetail = CarpoolingDetails::find($id);
        return view('user.carpooling_details.show', compact('carpoolingDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $carpoolingDetail = CarpoolingDetails::find($id);
        return view('user.carpooling_details.edit', compact('carpoolingDetail'));
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
        CarpoolingDetails::find($id)->delete();
        return redirect('user.carpooling_details')->with('success', 'Carpooling Detail deleted successfully.');
    }

    /**
     * Search for a carpooling detail.
     */
    public function search(Request $request)
    {

    }
}
