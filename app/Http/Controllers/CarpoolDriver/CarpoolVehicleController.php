<?php

namespace App\Http\Controllers\CarpoolDriver;

use App\Http\Controllers\Controller;
use App\Models\CarpoolDriver;
use App\Models\CarpoolVehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class CarpoolVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carpoolVehicles = CarpoolVehicle::paginate(10);
        return view('driver.carpool_vehicles.index', compact('carpoolVehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('driver.carpool_vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|string|numeric|before:' . Carbon::now()->format('Y'),
            'number_plate' => 'required|string|regex:/^[A-Z]{3}\s\d{3}[A-Z]$/',
            'capacity' => 'required|integer|between:1,20'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())->withInput();
        } else {
            $input = [
                'make' => $request->make,
                'model' => $request->model,
                'year' => $request->year,
                'number_plate' => $request->number_plate,
                'capacity' => $request->capacity
            ];

            // Insert and return latest id to save to carpool driver
            $carpool_vehicle_id = CarpoolVehicle::insertGetId($input);

            // Update the user's carpool driver record to include the carpool vehicle id
            $carpoolDriver = CarpoolDriver::where('user_id', Auth::id())->first();
            $carpoolDriver->carpool_vehicle_id = $carpool_vehicle_id;
            $carpoolDriver->save();

            return redirect('driver/carpool_vehicles')->with('success', 'Vehicle created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $carpoolVehicle = CarpoolVehicle::find($id);
        return view('driver.carpool_vehicles.show', compact('carpoolVehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $carpoolVehicle = CarpoolVehicle::find($id);
        return view('driver.carpool_vehicles.edit', compact('carpoolVehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request...
        $validator = Validator::make($request->all(), [
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|string|numeric|before:' . Carbon::now()->format('Y'),
            'number_plate' => 'required|string|regex:/^[A-Z]{3}\s\d{3}[A-Z]$/',
            'capacity' => 'required|integer|between:1,20'
        ]);

        if ($validator->fails()) {
            return redirect('carpool_vehicles/'.$id.'/edit')
                ->withErrors($validator->errors())->withInput();
        } else {
            $input = [
                'make' => $request->make,
                'model' => $request->model,
                'year' => $request->year,
                'number_plate' => $request->number_plate,
                'capacity' => $request->capacity
            ];

            CarpoolVehicle::find($id)->update($input);

            return redirect('driver/carpool_vehicles')->with('success', 'Vehicle updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CarpoolVehicle::find($id)->delete();
        return redirect('driver/carpool_vehicles')->with('success', 'Vehicle deleted successfully');
    }
}
