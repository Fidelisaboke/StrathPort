<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class SchoolVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $schoolVehicles = SchoolVehicle::paginate(10);
        return view('admin.school_vehicles.index', compact('schoolVehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        return view('admin.school_vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'school_driver_id' => 'nullable|exists:school_drivers,id',
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
                'school_driver_id' => $request->school_driver_id,
                'make' => $request->make,
                'model' => $request->model,
                'year' => $request->year,
                'number_plate' => $request->number_plate,
                'capacity' => $request->capacity,
                'availability_status' => $request->availability_status,
            ];

            SchoolVehicle::create($input);

            return redirect('admin/school_vehicles')->with('success', 'School Vehicle created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $schoolVehicle = SchoolVehicle::find($id);
        return view('admin.school_vehicles.show', compact('schoolVehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $schoolVehicle = SchoolVehicle::find($id);
        return view('admin.school_vehicles.edit', compact('schoolVehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'school_driver_id' => 'nullable|exists:school_drivers,id',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'number_plate' => 'required|string|regex:/^[A-Z]{3}\s\d{3}[A-Z]$/',
            'capacity' => 'required|integer|max:255',
            'availability_status' => 'required|string|in:Available,Unavailable',
        ]);

        if ($validator->fails()) {
            return redirect('admin/school_vehicles/'.$id.'/edit')
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $input = [
                'school_driver_id' => $request->school_driver_id,
                'make' => $request->make,
                'model' => $request->model,
                'year' => $request->year,
                'number_plate' => $request->number_plate,
                'capacity' => $request->capacity,
                'availability_status' => $request->availability_status,
            ];

            SchoolVehicle::find($id)->update($input);

            return redirect('admin/school_vehicles')->with('success', 'School Vehicle updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $schoolVehicle = SchoolVehicle::findOrFail($id);
        $schoolVehicle->delete();
    }

    /**
     * Search for a school vehicle.
     */
    public function search(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $search = $request->get('search');
        $schoolVehicles = SchoolVehicle::where('id', 'like', '%'.$search.'%')
            ->orWhere('school_driver_id', 'like', '%'.$search.'%')
            ->orWhere('make', 'like', '%'.$search.'%')
            ->orWhere('model', 'like', '%'.$search.'%')
            ->orWhere('year', 'like', '%'.$search.'%')
            ->orWhere('number_plate', 'like', '%'.$search.'%')
            ->orWhere('capacity', 'like', '%'.$search.'%')
            ->paginate(10);

        return view('admin.school_vehicles.index', compact('schoolVehicles'));
    }
}
