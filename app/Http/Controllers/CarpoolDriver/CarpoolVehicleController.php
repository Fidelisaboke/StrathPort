<?php

namespace App\Http\Controllers\CarpoolDriver;

use App\Http\Controllers\Controller;
use App\Models\CarpoolDriver;
use App\Models\CarpoolVehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;



class CarpoolVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        $carpoolDriverId = CarpoolDriver::where('user_id', Auth::id())->pluck('id');
        $carpoolVehicles = CarpoolVehicle::where('carpool_driver_id', $carpoolDriverId)->paginate(10);
        return view('driver.carpool_vehicles.index', compact('carpoolVehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        return view('driver.carpool_vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        $validator = Validator::make($request->all(), [
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|string|numeric|before:' . Carbon::now()->format('Y'),
            'number_plate' => 'required|string|regex:/^[A-Z]{3}\s\d{3}[A-Z]$/',
            'capacity' => 'required|integer|unsigned|between:1,20'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())->withInput();
        } else {
            $input = [
                'carpool_driver_id' => $request->carpool_driver_id,
                'make' => $request->make,
                'model' => $request->model,
                'year' => $request->year,
                'number_plate' => $request->number_plate,
                'capacity' => $request->capacity
            ];

            // Insert and return latest id to save to carpool driver
            $carpoolVehicleId = CarpoolVehicle::insertGetId($input);

            // Update the user's carpool driver record to include the carpool vehicle id
            $carpoolDriver = CarpoolDriver::where('user_id', Auth::id())->first();
            $carpoolDriver->carpool_vehicle_id = $carpoolVehicleId;
            $carpoolDriver->save();

            return redirect('driver/carpool_vehicles')->with('success', 'Vehicle created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        $carpoolVehicle = CarpoolVehicle::find($id);
        return view('driver.carpool_vehicles.show', compact('carpoolVehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        $carpoolVehicle = CarpoolVehicle::find($id);
        return view('driver.carpool_vehicles.edit', compact('carpoolVehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

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
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');
        
        CarpoolVehicle::find($id)->delete();
        return redirect('driver/carpool_vehicles')->with('success', 'Vehicle deleted successfully');
    }
}
