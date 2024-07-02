<?php

namespace App\Http\Controllers;

use App\Models\CarpoolVehicle;
use Illuminate\Http\Request;

class CarpoolVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carpoolVehicles = CarpoolVehicle::paginate(10);
        return view('user.carpool_vehicles.index', compact('carpoolVehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.carpool_vehicles.create');
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
        $carpoolVehicle = CarpoolVehicle::find($id);
        return view('user.carpool_vehicles.show', compact('carpoolVehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $carpoolVehicle = CarpoolVehicle::find($id);
        return view('user.carpool_vehicles.edit', compact('carpoolVehicle'));
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
        CarpoolVehicle::find($id)->delete();
        return redirect('user.carpool_vehicles.index')->with('success', 'Vehicle deleted successfully');
    }
}
