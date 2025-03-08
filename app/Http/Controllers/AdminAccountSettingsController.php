<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminAccountSettingsController extends Controller
{


    public function admin_account_settings(Request $request)
    {
        $user_information = array(
            'info' => $request->user(), //retrieves the currently login user info
        );

        return view("admin.account_settings", $user_information);
    }


    public function update_admin_account_settings(Request $request)
    {
        // validate the incoming request data
        $request->validate([
            'firstname_' => 'required|string|max:255',
            'middlename_' => 'required|string|max:255',
            'lastname_' => 'required|string|max:255',
            'email_' => 'required|email|max:255|unique:admin_info,email,' . auth()->user()->id,
            'password_' => 'nullable|string|min:5', 
            'profilepicture_' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        // get the authenticated admin user
        $admin = auth()->user();

        // update the admin's basic information directly from the request
        $admin->first_name = $request->input('firstname_');
        $admin->middle_name = $request->input('middlename_');
        $admin->last_name = $request->input('lastname_');
        $admin->email = $request->input('email_');

        // check if password is provided and hash it
        if ($request->filled('password_')) {
            $admin->password = Hash::make($request->input('password_'));
        }
        
        // handle profile picture upload
        if ($request->hasFile('profilepicture_')) {
            // check if the current profile picture is not the default one
            if ($admin->profile_picture !== 'profile_pictures/msdefault.jpg' && file_exists(public_path($admin->profile_picture))) {
                // delete the old custom profile picture (but not the default)
                unlink(public_path($admin->profile_picture)); // delete the old file
            }

            // upload the new profile picture
            $file = $request->file('profilepicture_');

            // ensure the file is valid
            if ($file->isValid()) {
                // generate a unique filename
                $fileName = time() . '.' . $file->getClientOriginalExtension();

                // move the uploaded file to the 'profile_pictures' folder
                $file->move(public_path('profile_pictures'), $fileName);

                // save the new profile picture path in the database
                $admin->profile_picture = 'profile_pictures/' . $fileName;
            } else {
                return back()->withErrors(['profilepicture_' => 'Invalid file upload!']);
            }
        }

        // save changes to database
        $admin->save();

        // reload the updated user information for the view
        $updated_admin = auth()->user();

        // redirect back to account settings with updated info and success message
        return redirect()->route('admin.account_settings')->with('success', 'Account updated successfully!');
    }

}
