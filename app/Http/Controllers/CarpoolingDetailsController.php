<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarpoolingDetails;

class CarpoolingDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carpoolingDetails = CarpoolingDetails::paginate(10);
        return view('carpooling_details.index', compact('carpoolingDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('carpooling_details.create');
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
        return view('carpooling_details.show', compact('carpoolingDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $carpoolingDetail = CarpoolingDetails::find($id);
        return view('carpooling_details.edit', compact('carpoolingDetail'));
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
        return redirect('carpooling_details')->with('success', 'Carpooling Detail deleted successfully.');
    }
}
