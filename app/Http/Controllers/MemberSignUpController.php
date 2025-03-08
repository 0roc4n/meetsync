<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
use App\Models\PendingUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MemberSignUpController extends Controller
{


    public function member_sign_up_form()
    {
        return view("member_sign_up_form");
    }

    

    public function member_sign_up_process(Request $request)
    {
        if ($request->input("password") != $request->input("confirm_password")) {
            return redirect("/member_sign_up_form")->with('error', 'Passwords do not match.');
        }

        // Check if the email is already registered in the Members table
        $email_used = \App\Models\Members::where('email', $request->input('email'))->first();
        if ($email_used) {
            return redirect("/member_sign_up_form")->with('error', 'The email is already registered.');
        }

        // insert into the pending_users table
        PendingUser::create([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'organizations_name' => $request->input('organizations_name') ?? 'og_name',
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'member',
        ]);

        return redirect("/")->with('success', 'Account created and awaiting admin approval.');
    }


}




















// $information = array(
    //'first_name' => $request->input('first_name'),
    //'last_name' => $request->input('last_name'),
    //'organizations_name' => $request->input('organizations_name') ?? 'og_name',
    //'email' => $request->input('email'),
    //'password' => Hash::make($request->input('password')),
    //'role' => $request->input('role'),
    //'profile_picture' => 'profile_pictures/msdefault.jpg',
    //'manager' => $managerValue,
// );
// Create the user
// User::create($information);