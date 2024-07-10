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

        $carpoolDrivers = carpoolDriver::paginate(10);
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

        $carpoolDrivers = carpoolDriver::paginate(10);
        return view('admin.carpool_drivers.index', compact('carpoolDrivers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $carpoolDrivers = carpoolDriver::paginate(10);
        return view('admin.carpool_drivers.index', compact('carpoolDrivers'));
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
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        CarpoolDriver::find($id)->delete();
        return redirect('admin/carpool_drivers')->with('success', 'Carpool Driver deleted successfully');
    }

     /**
     * Search for a school driver.
     */
    public function search(Request $request)
    {
        //
    }
}
