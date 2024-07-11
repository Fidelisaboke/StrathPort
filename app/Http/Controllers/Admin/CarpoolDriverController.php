<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarpoolDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CarpoolDriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $carpoolDrivers = carpoolDriver::latest()->paginate(10);
        return view('admin.carpool_drivers.index', compact('carpoolDrivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        return view('admin.carpool_drivers.create');
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
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $carpoolDriver = CarpoolDriver::findOrFail($id);
        return view('admin.carpool_drivers.show', compact('carpoolDriver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $carpoolDriver = carpoolDriver::findOrFail($id);
        return view('admin.carpool_drivers.edit', compact('carpoolDriver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|alpha|max:255',
            'last_name' => 'required|alpha|max:255',
            'availability_status' => 'required|string|in:Available,Unavailable',
        ]);

        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        $input = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'availability_status' => $request->availability_status,
        ];

        CarpoolDriver::find($id)->update($input);

        return redirect('admin/carpool_drivers')->with('success', 'Carpool Driver updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        CarpoolDriver::find($id)->delete();
        return redirect('admin/carpool_drivers')->with('success', 'Carpool Driver deleted successfully');
    }

     /**
     * Search for a carpool driver.
     */
    public function search(Request $request)
    {
        $search = $request->search;

        $carpoolDrivers = CarpoolDriver::where('first_name', 'like', '%'.$search.'%')
            ->orWhere('last_name', 'like', '%'.$search.'%')
            ->latest()->paginate(10);

        return view('admin.carpool_drivers.index', compact('carpoolDrivers'));
    }

    /**
     * Filter carpool drivers by availability status.
     */
    public function filter(Request $request)
    {
        $filter = $request->get('status');

        if($filter == 'All'){
            $carpoolDrivers = CarpoolDriver::latest()->paginate(10);
        }else{
            $carpoolDrivers = CarpoolDriver::where('availability_status', $filter)->latest()->paginate(10);
        }

        return view('admin.carpool_drivers.index', compact('carpoolDrivers'));
    }
}
