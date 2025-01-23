<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $students = Student::paginate(10);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        return view('admin.students.create');
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
            'student_school_id' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('admin.students.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            Student::create($request->all());
            return redirect('admin.students.index')->with('success', 'Student created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $student = Student::find($id);
        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $student = Student::find($id);
        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'student_school_id' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('admin.students.edit', $id)
                ->withErrors($validator->error())
                ->withInput();
        } else {
            $student = Student::find($id);
            $student->update($request->all());
            return redirect('admin.students.index')->with('success', 'Student updated successfully');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        Student::find($id)->delete();
        return redirect('admin.students.index')->with('success', 'Student deleted successfully');
    }

    /**
     * Search for a student
     */
    public function search(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $search = $request->search;
        $students = Student::where(function($query) use ($search){
            $query->where('id', 'like', '%' . $search . '%')
                ->orWhere('user_id', 'like', '%' . $search . '%')
                ->orWhere('student_school_id', 'like', '%' . $search . '%')
                ->orWhere('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('admin.students.index', compact('students'));
    }
}
