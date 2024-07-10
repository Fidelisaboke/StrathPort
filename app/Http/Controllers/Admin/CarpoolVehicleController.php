<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarpoolVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
            'availability_status' => 'required|string|in:Available,Unavailable',
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
                'availability_status' => $request->availability_status,
            ];

            CarpoolVehicle::create($input);

            return redirect('admin/carpool_vehicles')->with('success', 'Carpool Vehicle created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $carpoolVehicles = carpoolVehicle::paginate(10);
        return view('admin.carpool_vehicles.index', compact('carpoolVehicles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $carpoolVehicles = carpoolVehicle::paginate(10);
        return view('admin.carpool_vehicles.index', compact('carpoolVehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
            'availability_status' => 'required|string|in:Available,Unavailable',
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
                'availability_status' => $request->availability_status,
            ];

            CarpoolVehicle::create($input);

            return redirect('admin/carpool_vehicles')->with('success', 'Carpool Vehicle created successfully.');
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
