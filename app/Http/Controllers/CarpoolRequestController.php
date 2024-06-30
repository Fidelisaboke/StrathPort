<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarpoolRequest;

class CarpoolRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carpoolRequests = CarpoolRequest::paginate(10);
        return view('carpool_requests.index', compact('carpoolRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('carpool_requests.create');
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
        return view('carpool_requests.show', compact('carpoolRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $carpoolRequest = CarpoolRequest::find($id);
        return view('carpool_requests.edit', compact('carpoolRequest'));
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
       CarpoolRequest::find($id)->delete();
         return redirect('carpool_requests')->with('success', 'Carpool Request deleted successfully.');
    }
}
