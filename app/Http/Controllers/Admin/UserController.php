<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Staff;
use App\Models\CarpoolDriver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AccountActivatedNotification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        // Validate the request...

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => Password::defaults(),
            'secondary_email' => 'nullable|email',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|regex:/^(\+254)[0-9]{9}$/',
            'account_status' => 'nullable|string|in:active,inactive',
            'roles' => 'nullable|array|size:1',
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
                'account_status' => $request->account_status,
            ];

            $user = User::create($input);
            $user->assignRole($request->roles);

            return redirect('admin/users')->with('success', 'User created successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'secondary_email' => 'nullable|email',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|regex:/^(\+254)[0-9]{9}$/',
            'roles' => 'nullable|array|size:1',
            'account_status' => 'nullable|string|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect('admin/users/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $input = [
                'name' => $request->name,
                'email' => $request->email,
                'secondary_email' => $request->secondary_email,
                'address' => $request->address,
                'phone' => $request->phone,
                'account_status' => $request->account_status,
            ];

            $user = User::find($id);
            $previousStatus = $user->account_status;

            User::find($id)->update($input);

            // Prevent changing of roles if the user already has a role
            if ($user->roles->count() == 0 || $request->roles[0] == $user->roles[0]->name) {
                $user->assignRole($request->roles);

                // create corresponding student, staff, or carpool driver record
                if ($request->roles[0] == 'student') {
                    $student = new Student();
                    $student->user_id = auth()->id();
                    $student->save();
                } elseif ($request->roles[0] == 'staff') {
                    $staff = new Staff();
                    $staff->user_id = auth()->id();
                    $staff->save();
                } elseif ($request->roles[0] == 'carpool_driver') {
                    $carpoolDriver = new CarpoolDriver();
                    $carpoolDriver->user_id = auth()->id();
                    $carpoolDriver->save();
                }
            } else {
                // Return error message if user already has a role
                return redirect('admin/users/' . $id . '/edit')
                ->with('error', 'Cannot change roles for a user with existing roles!')
                ->withInput();
            }

            // Check if account was inactive and has now been changed to active
            if ($previousStatus == 'inactive' && $request->account_status == 'active') {
                Notification::send($user, new AccountActivatedNotification());
            }

            return redirect('admin/users')->with('success', 'User updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        // Prevent deleting admins
        $user = User::find($id);
        if ($user->hasRole('admin')) {
            return redirect('admin/users')->with('error', 'Cannot delete an admin!');
        } else {
            User::find($id)->delete();
        }

        return redirect('admin/users')->with('success', 'User deleted successfully!');
    }

    /**
     * Search for a user
     */
    public function search(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $search = $request->input('search');
        $users = User::where(function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('secondary_email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('admin.users.index', compact('users'));
    }
}
