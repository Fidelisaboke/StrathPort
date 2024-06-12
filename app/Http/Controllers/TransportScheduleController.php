<?php

namespace App\Http\Controllers;
use App\Models\TransportSchedule;

use Illuminate\Http\Request;

class TransportScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transport_schedules = TransportSchedule::all();
        return view('transport_schedules.index', compact('transport_schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $transport_schedule = TransportSchedule::find($id);
        return view('transport_schedules.show', compact('transport_schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }
}
