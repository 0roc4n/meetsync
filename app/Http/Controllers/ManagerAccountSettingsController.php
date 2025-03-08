<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Members; // for when updating organization's name
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ManagerAccountSettingsController extends Controller
{


    public function manager_account_settings(Request $request)
    {
        $user_information = array(
            'info' => $request->user(), //retrieves the currently login user info
        );

        return view("manager.account_settings", $user_information);
    }


    public function update_manager_account_settings(Request $request)
    {
        // validate the incoming request data
        $request->validate([
            'firstname_' => 'required|string|max:255',
            'middlename_' => 'required|string|max:255',
            'lastname_' => 'required|string|max:255',
            'organizationsname_' => 'required|string|max:255',
            'email_' => 'required|email|max:255|unique:managers_info,email,' . auth()->user()->id,
            'password_' => 'nullable|string|min:5', 
            'profilepicture_' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        // get the authenticated manager user
        $manager = auth()->user();

        // update the manager's basic information directly from the request
        $manager->first_name = $request->input('firstname_');
        $manager->middle_name = $request->input('middlename_');
        $manager->last_name = $request->input('lastname_');
        $manager->organizations_name = $request->input('organizationsname_');
        $manager->email = $request->input('email_');

        // check if password is provided and hash it
        if ($request->filled('password_')) {
            $manager->password = Hash::make($request->input('password_'));
        }

        // handle profile picture upload
        if ($request->hasFile('profilepicture_')) {
            // check if the current profile picture is not the default one
            if ($manager->profile_picture !== 'profile_pictures/msdefault.jpg' && file_exists(public_path($manager->profile_picture))) {
                // delete the old custom profile picture (but not the default)
                unlink(public_path($manager->profile_picture)); // delete the old file
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
                $manager->profile_picture = 'profile_pictures/' . $fileName;
            } else {
                return back()->withErrors(['profilepicture_' => 'Invalid file upload!']);
            }
        }

        // save changes to manager's database record
        $manager->save();

        // update the organization name for all members managed by this manager
        $members = Members::where('manager', $manager->id)->get(); // get all members where the manager_id matches
        foreach ($members as $member) {
            $member->organizations_name = $manager->organizations_name; // update organization name members
            $member->save(); // save the changes
        }

        // reload the updated user information for the view
        $updated_manager = auth()->user();

        // redirect back to account settings with updated info and success message
        return redirect()->route('manager.account_settings')->with('success', 'Account updated successfully!');
    }


}
