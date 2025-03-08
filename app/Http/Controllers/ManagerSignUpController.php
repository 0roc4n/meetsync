<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\PendingUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ManagerSignUpController extends Controller
{


    public function manager_sign_up_form()
    {
        return view("manager_sign_up_form");
    }


    public function manager_sign_up_process(Request $request) 
    {
        // validate passwords match
        if ($request->input("password") != $request->input("confirm_password")) {
            return redirect("/manager_sign_up_form")->with('error', 'Passwords do not match.');
        }

        // check if the email is already registered in the Manager table
        $email_used = \App\Models\Manager::where('email', $request->input('email'))->first();
        if ($email_used) {
            return redirect("/manager_sign_up_form")->with('error', 'The email is already registered.');
        }

        // insert into the pending_users table
        PendingUser::create([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'organizations_name' => $request->input('organizations_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'manager',  
        ]);

        // redirect with success message
        return redirect("/")->with('success', 'Account created and awaiting admin approval.');
    }



}
