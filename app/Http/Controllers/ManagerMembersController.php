<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Members;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ManagerMembersController extends Controller
{


    public function members_table()
    {
        // get the logged-in manager's id using the 'manager' guard
        $manager_id = Auth::guard('manager')->id();
        
        // get the manager's details
        $manager = \App\Models\Manager::find($manager_id);
        
        // get the members of the manager's organization
        $members = \App\Models\Members::where('manager', $manager_id)->get();
        
        // pass the manager and members to the view
        return view("manager.members", [
            'manager' => $manager,
            'members' => $members,
        ]);
    }





    public function add_member(Request $request)
    {
        // validate the request
        $request->validate([
            'email' => 'required|email',
        ]);

        // get the email entered by the user/manager
        $email = $request->input('email');

        // find the member by email and check if they have the "member" role
        $member = \App\Models\Members::where('email', $email)->where('role', 'member')->first();

        if ($member) {
            // check if the member is already assigned to a different manager
            if ($member->manager && $member->manager != Auth::guard('manager')->id()) {
                return redirect('/members')->with('error', "This email is already associated with another manager's organization.");
            }

            // retrieve manager's details using the 'manager' guard
            $manager = Auth::guard('manager')->user();

            // find the manager in the Manager model by ID to get the first name and last name
            $managerDetails = \App\Models\Manager::find($manager->id);

            // access the manager's first name and last name
            $managerFirstName = $managerDetails->first_name;
            $managerLastName = $managerDetails->last_name;

            // combine names
            $managerFullName = $managerFirstName . ' ' . $managerLastName;
            $member->organizations_name = $manager->organizations_name;
            $member->manager = $manager->id;
            $member->save();

            // get the ID of the newly added member
            $new_member_id = $member->id;

            // add the notification to the MemberNotifications1 table
            \App\Models\MemberNotifications1::create([
                'time' => Carbon::now('Asia/Manila'),
                'manager_id' => $manager->id,
                'organizations_name' => $manager->organizations_name,
                'manager_name' => $managerFullName, 
                'member_id' => $new_member_id,  // add member_id here
            ]);

            return redirect('/members')->with('success', 'Member added successfully.');
        } else {
            return redirect('/members')->with('error', 'Email is not registered as a member.');
        }
    }






    public function remove_member($id)
    {
        // find the member by their id
        $member = \App\Models\Members::find($id);

        if ($member) {
            // change the member's organization and manager fields to default values
            $member->organizations_name = 'og_name';
            $member->manager = 0; 
            $member->save();

            return redirect('/members')->with('success', 'Member removed successfully.');
        } else {
            return redirect('/members')->with('error', 'Member not found.');
        }
    }




}
