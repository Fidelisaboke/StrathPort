<?php

namespace App\Http\Controllers\CarpoolDriver;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CarpoolDriver;
use App\Models\CarpoolVehicle;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



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
        // Check if the user is a carpool driver and has not added a vehicle
        abort_unless(Gate::allows('carpool_driver') && !CarpoolVehicle::where('carpool_driver_id', Auth::user()->carpoolDriver->id)->exists(), 403, 'Forbidden');

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
            'year' => 'required|string|integer|before:' . Carbon::now()->format('Y'),
            'number_plate' => 'required|string|regex:/^[A-Z]{3}\s\d{3}[A-Z]$/',
            'capacity' => 'required|integer|between:1,20',
            'vehicle_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

            if ($request->hasFile('vehicle_photo')) {
                $directory = 'carpool_vehicles';

                // Create the directory if it doesn't exist
                Storage::disk('public')->makeDirectory($directory);

                $file = $request->file('vehicle_photo');

                // Rename the file to prevent overriding
                $fileName = time() . '_' . str_replace(' ', '_', $input['number_plate']) . '.' . $file->getClientOriginalExtension();

                // Store the file on the public disk
                $path = Storage::disk('public')->putFileAs($directory, $file, $fileName);

                $input['vehicle_photo_path'] = $path;
            }

            $carpoolVehicle = CarpoolVehicle::create($input);

            if ($carpoolVehicle) {
                return redirect('driver/carpool_vehicles')->with('success', 'Vehicle added successfully.');
            }

            return redirect('driver/carpool_vehicles')->with('error', 'Error adding vehicle.');
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

        $validator = Validator::make($request->all(), [
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|string|integer|before:' . Carbon::now()->format('Y'),
            'number_plate' => 'required|string|regex:/^[A-Z]{3}\s\d{3}[A-Z]$/',
            'capacity' => 'required|integer|between:1,20',
            'vehicle_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

            if ($request->hasFile('vehicle_photo')) {
                $directory = 'carpool_vehicles';

                // Create the directory if it doesn't exist
                Storage::disk('public')->makeDirectory($directory);

                $file = $request->file('vehicle_photo');

                // Rename the file to prevent overriding
                $fileName = time() . '_' . str_replace(' ', '_', $input['number_plate']) . '.' . $file->getClientOriginalExtension();

                // Store the file on the public disk
                $path = Storage::disk('public')->putFileAs($directory, $file, $fileName);

                $input['vehicle_photo_path'] = $path;
            }

            $carpoolVehicle = CarpoolVehicle::find($id)->update($input);

            if($carpoolVehicle){
                return redirect('driver/carpool_vehicles')->with('success', 'Vehicle updated successfully.');
            }

            return redirect('driver/carpool_vehicles')->with('error', 'Failed to update vehicle.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::allows('carpool_driver'), 403, 'Forbidden');

        CarpoolVehicle::find($id)->delete();
        return redirect('driver/carpool_vehicles')->with('success', 'Vehicle deleted successfully.');
    }
}
