<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $staff = Staff::paginate(10);
        return view('admin.staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        return view('admin.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'staff_school_id' => 'required|string|max:255',
            'first_name' => 'required|string|max:60',
            'last_name' => 'required|string|max:60',
        ]);

        if ($validator->fails()) {
            return redirect('admin.staff.create')
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            Staff::create($request->all());
            return redirect('admin.staff.index')->with('success', 'Staff created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $staff = Staff::find($id);
        return view('admin.staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $staff = Staff::find($id);
        return view('admin.staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'staff_school_id' => 'required|string|max:255',
            'first_name' => 'required|string|max:60',
            'last_name' => 'required|string|max:60',
        ]);

        if ($validator->fails()) {
            return redirect('admin.staff.edit')
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            Staff::find($id)->update($request->all());
            return redirect('admin.staff.index')->with('success', 'Staff updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        Staff::find($id)->delete();
        return redirect('admin.staff.index')->with('success', 'Staff deleted successfully');
    }

    /**
     * Search for a staff.
     */
    public function search(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $search = $request->search;
        $staff = Staff::where(function($query) use ($search){
            $query->where('id', 'like', '%' . $search . '%')
                ->orWhere('user_id', 'like', '%' . $search . '%')
                ->orWhere('staff_school_id', 'like', '%' . $search . '%')
                ->orWhere('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('admin.staff.index', compact('staff'));
    }
}
