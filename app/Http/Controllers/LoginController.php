<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Manager;
use App\Models\Member;
use App\Models\PendingUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    
    public function login_form()
    {
        return view ("login_form");
    }



    public function login_process(Request $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        // check if credentials exist in PendingUser
        $pendingUser = PendingUser::where('email', $credentials['email'])->first();

        if ($pendingUser && Hash::check($credentials['password'], $pendingUser->password)) {
            // if credentials match a PendingUser record, return with an error
            return redirect()->back()->with('error', 'Your account is pending admin approval.');
        }

        // list of guards to check
        $guards = [
            'admin' => 'admin.dashboard',
            'manager' => 'manager.home',
            'member' => 'member.home',
        ];

        // iterate over guards
        foreach ($guards as $guard => $route) {
            if (Auth::guard($guard)->attempt($credentials)) {
                // If authentication succeeds, redirect to the guard's home route
                return redirect()->route($route);
            }
        }

        // if no guard matches, redirect back with error
        return redirect('/')->with('error', 'Wrong email or password.');
    }



    

    public function logout(Request $request)
    {
        // logout from the current guard
        Auth::guard('admin')->logout();
        Auth::guard('manager')->logout();
        Auth::guard('member')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    

}
