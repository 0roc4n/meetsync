<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MemberAccountSettingsController extends Controller
{


    public function member_account_settings(Request $request)
    {
        $user_information = array(
            'info' => $request->user(), //retrieves the currently login user info
        );

        return view("member.account_settings", $user_information);
    }



    public function update_member_account_settings(Request $request)
    {
        // validate the incoming request data
        $request->validate([
            'firstname_' => 'required|string|max:255',
            'middlename_' => 'required|string|max:255',
            'lastname_' => 'required|string|max:255',
            'organizationsname_' => 'required|string|max:255',
            'email_' => 'required|email|max:255|unique:members_info,email,' . auth()->user()->id,
            'password_' => 'nullable|string|min:5', 
            'profilepicture_' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        // get the authenticated member user
        $member = auth()->user();

        // update the member's basic information directly from the request
        $member->first_name = $request->input('firstname_');
        $member->middle_name = $request->input('middlename_');
        $member->last_name = $request->input('lastname_');
        $member->organizations_name = $request->input('organizationsname_');
        $member->email = $request->input('email_');

        // check if password is provided and hash it
        if ($request->filled('password_')) {
            $member->password = Hash::make($request->input('password_'));
        }

        // handle profile picture upload
        if ($request->hasFile('profilepicture_')) {
            // check if the current profile picture is not the default one
            if ($member->profile_picture !== 'profile_pictures/msdefault.jpg' && file_exists(public_path($member->profile_picture))) {
                // delete the old custom profile picture (but not the default)
                unlink(public_path($member->profile_picture)); // delete the old file
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
                $member->profile_picture = 'profile_pictures/' . $fileName;
            } else {
                return back()->withErrors(['profilepicture_' => 'Invalid file upload!']);
            }
        }

        // save changes to database
        $member->save();

        // reload the updated user information for the view
        $updated_member = auth()->user();

        // redirect back to account settings with updated info and success message
        return redirect()->route('member.account_settings')->with('success', 'Account updated successfully!');
    }


}
