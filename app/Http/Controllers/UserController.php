<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Gate::allows('admin')){
            abort(403, 'You are not authorized to access this page');
        } else {
            $users = User::paginate(10);
            return view('admin.users.index', compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Gate::allows('admin')){
            abort(403, 'You are not authorized to access this page');
        } else {
            return view('admin.users.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Gate::allows('admin')){
            abort(403, 'You are not authorized to access this page');
        } else {
            // Validate the request...

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!Gate::allows('admin')){
            abort(403, 'You are not authorized to access this page');
        } else {
            $user = User::find($id);
            return view('admin.users.show', compact('user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!Gate::allows('admin')){
            abort(403, 'You are not authorized to access this page');
        } else {
            $user = User::find($id);
            return view('admin.users.edit', compact('user'));
        }
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
        if(!Gate::allows('admin')){
            abort(403, 'You are not authorized to access this page');
        } else {
            User::find($id)->delete();
        }
    }
}
