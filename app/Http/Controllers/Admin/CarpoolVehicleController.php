<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CarpoolVehicle;
use App\Http\Controllers\Controller;
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
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $carpoolVehicles = carpoolVehicle::paginate(10);
        return view('admin.carpool_vehicles.index', compact('carpoolVehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        return view('admin.carpool_vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'carpool_driver_id' => 'nullable|exists:carpool_drivers,id',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'number_plate' => 'required|string|regex:/^[A-Z]{3}\s\d{3}[A-Z]$/',
            'capacity' => 'required|integer|max:255',
            'vehicle_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $input = [
                'carpool_driver_id' => $request->carpool_driver_id,
                'make' => $request->make,
                'model' => $request->model,
                'year' => $request->year,
                'number_plate' => $request->number_plate,
                'capacity' => $request->capacity,
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

            if(!$carpoolVehicle){
                return redirect('admin/carpool_vehicles')
                ->with('error', 'Error creating the carpool vehicle')
                ->withInput();
            }

            return redirect('admin/carpool_vehicles')->with('success', 'Carpool Vehicle created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $carpoolVehicle = CarpoolVehicle::findOrFail($id);
        return view('admin.carpool_vehicles.show', compact('carpoolVehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $carpoolVehicle = CarpoolVehicle::findOrFail($id);
        return view('admin.carpool_vehicles.edit', compact('carpoolVehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'number_plate' => 'required|string|regex:/^[A-Z]{3}\s\d{3}[A-Z]$/',
            'capacity' => 'required|integer|max:255',
            'vehicle_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $input = [
                'make' => $request->make,
                'model' => $request->model,
                'year' => $request->year,
                'number_plate' => $request->number_plate,
                'capacity' => $request->capacity,
            ];

            $carpoolVehicle = CarpoolVehicle::findOrFail($id);

            // Check if the user wants to remove the photo
            $removePhoto = $request->boolean('remove_photo');

            if ($removePhoto) {
                // Remove the existing photo if it exists
                if ($carpoolVehicle->vehicle_photo_path) {
                    Storage::disk('public')->delete($carpoolVehicle->vehicle_photo_path);
                }

                $input['vehicle_photo_path'] = null;
            }

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

            $vehicleUpdated = CarpoolVehicle::find($id)->update($input);

            if(!$vehicleUpdated){
                return redirect('admin/carpool_vehicles')
                ->with('error', 'Error updating the carpool vehicle')
                ->withInput();
            }

            return redirect('admin/carpool_vehicles')->with('success', 'Carpool Vehicle updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        CarpoolVehicle::find($id)->delete();
        return redirect('admin/carpool_vehicles')->with('success', 'Carpool Vehicle deleted successfully');
    }

     /**
     * Search for a carpool driver.
     */
    public function search(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $search = $request->get('search');
        $carpoolVehicles = CarpoolVehicle::where('id', 'like', '%'.$search.'%')
            ->orWhere('carpool_driver_id', 'like', '%'.$search.'%')
            ->orWhere('make', 'like', '%'.$search.'%')
            ->orWhere('model', 'like', '%'.$search.'%')
            ->orWhere('year', 'like', '%'.$search.'%')
            ->orWhere('number_plate', 'like', '%'.$search.'%')
            ->orWhere('capacity', 'like', '%'.$search.'%')
            ->paginate(10);

        return view('admin.carpool_vehicles.index', compact('carpoolVehicles'));
    }
}
