<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Gate::allows('admin')){
            abort(403, 'Unauthorized');
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
            abort(403, 'Unauthorized');
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
            abort(403, 'Unauthorized');
        } else {
            // Validate the request...

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'password' => Password::defaults(),
                'secondary_email' => 'nullable|email',
                'address' => 'nullable|string',
                'phone' => 'nullable|string|regex:/^(\+254)[0-9]{9}$/',
            ]);

            if ($validator->fails()) {
                return redirect('admin/users/create')
                            ->withErrors($validator)
                            ->withInput();
            } else {
                $input = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'secondary_email' => $request->secondary_email,
                    'address' => $request->address,
                    'phone' => $request->phone,
                ];

                User::create($input);

                return redirect('admin/users')->with('success', 'User created successfully!');
            }

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!Gate::allows('admin')){
            abort(403, 'Unauthorized');
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
            abort(403, 'Unauthorized');
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
        if(!Gate::allows('admin')){
            abort(403, 'Unauthorized');
        } else {
            // Validate the request...
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email,'.$id,
                'secondary_email' => 'nullable|email',
                'address' => 'nullable|string',
                'phone' => 'nullable|string|regex:/^(\+254)[0-9]{9}$/',
            ]);

            if ($validator->fails()) {
                return redirect('admin/users/'.$id.'/edit')
                            ->withErrors($validator)
                            ->withInput();
            } else {
                $input = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'secondary_email' => $request->secondary_email,
                    'address' => $request->address,
                    'phone' => $request->phone,
                ];

                User::find($id)->update($input);

                return redirect('admin/users')->with('success', 'User updated successfully!');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!Gate::allows('admin')){
            abort(403, 'Unauthorized');
        } else {
            User::find($id)->delete();
            return redirect('admin/users')->with('success', 'User deleted successfully!');
        }
    }

    /**
     * Search for a user
     */
    public function search(Request $request)
    {
        if(!Gate::allows('admin')){
            abort(403, 'Unauthorized');
        } else {
            $search = $request->input('search');
            $users = User::where(function($query) use ($search){
                        $query->where('name', 'like', '%'.$search.'%')
                        ->orWhere('email', 'like', '%'.$search.'%')
                        ->orWhere('secondary_email', 'like', '%'.$search.'%')
                        ->orWhere('phone', 'like', '%'.$search.'%')
                        ->orWhere('address', 'like', '%'.$search.'%');
            })->paginate(10);

            return view('admin.users.index', compact('users'));
        }
    }


}
