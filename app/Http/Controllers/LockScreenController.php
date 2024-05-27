<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LockScreenController extends Controller
{
    public function show(){
        session (['locked' => true]);
        return view('lock');
    }

    public function unlock(Request $request){

        // Validate password
        $request->validate([
            'password' => 'required|string',
        ]);

        // Check if password is correct
        $user = Auth::user();

        if(Hash::check($request->password, $user->password)){
            session(['locked' => false]);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['password' => 'The password is incorrect.']);
    }
}
