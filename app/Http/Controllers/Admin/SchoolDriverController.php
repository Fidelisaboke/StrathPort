<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class SchoolDriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $schoolDrivers = SchoolDriver::paginate(10);
        return view('admin.school_drivers.index', compact('schoolDrivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        return view('admin.school_drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:60',
            'last_name' => 'required|string|max:60',
            'phone' => 'required|string|max:15',
            'availability_status' => 'required|in:Available,Unavailable',
        ]);

        if ($validator->fails()) {
            return redirect('admin/school_drivers/create')
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $input = [
                'school_vehicle_id' => $request->school_vehicle_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'availability_status' => $request->availability_status,
            ];

            SchoolDriver::create($input);
            return redirect('admin/school_drivers')->with('success', 'School driver created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $schoolDriver = SchoolDriver::find($id);
        return view('admin.school_drivers.show', compact('schoolDriver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $schoolDriver = SchoolDriver::find($id);
        return view('admin.school_drivers.edit', compact('schoolDriver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:60',
            'last_name' => 'required|string|max:60',
            'phone' => 'required|string|max:15',
            'availability_status' => 'required|in:Available,Unavailable',
        ]);

        if ($validator->fails()) {
            return redirect('admin/school_drivers/' . $id . '/edit')
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $input = [
                'school_vehicle_id' => $request->school_vehicle_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'availability_status' => $request->availability_status,
            ];

            SchoolDriver::find($id)->update($input);
            return redirect('admin/school_drivers')->with('success', 'School driver updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        SchoolDriver::find($id)->delete();
        return redirect('admin/school_drivers')->with('success', 'School driver deleted successfully');
    }

    /**
     * Search for a school driver.
     */
    public function search(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $schoolDrivers = SchoolDriver::where('first_name', 'like', '%' . $request->search . '%')
            ->orWhere('last_name', 'like', '%' . $request->search . '%')
            ->orWhere('phone', 'like', '%' . $request->search . '%')
            ->orWhere('availability_status', 'like', '%' . $request->search . '%')
            ->paginate(10);
        return view('admin.school_drivers.index', compact('schoolDrivers'));
    }
}
