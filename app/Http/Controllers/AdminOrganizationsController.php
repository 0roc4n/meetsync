<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Manager;
use Illuminate\Http\Request;

class AdminOrganizationsController extends Controller
{

    
    public function organizations()
    {
        // get all managers
        $managers = Manager::all();

        // for each manager, get the associated members
        $organization_members = $managers->map(function($manager) {
            $manager->members = Members::where('manager', $manager->id)->get(); // get members associated with the manager
            return $manager;
        });

        // pass the data to the view
        return view('admin.organizations', compact('organization_members'));
    }



    public function switch_role($manager_id, $member_id)
    {
        // get both the manager and the member
        $manager = Manager::findOrFail($manager_id);
        $member = Members::findOrFail($member_id);

        // save the original data of both the manager and the member
        $oldManagerData = $manager->toArray();
        $oldMemberData = $member->toArray();

        // for swapping manager and member data
        // update manager to have member's details
        $manager->first_name = $member->first_name;
        $manager->last_name = $member->last_name;
        $manager->email = $member->email;
        $manager->password = $member->password; // use the member's password
        $manager->profile_picture = $member->profile_picture;
        $manager->role = 'manager'; // Cchange the role to manager
        $manager->manager = $manager_id; // keep the same manager ID
        $manager->save();

        // update member to have manager's details
        $member->first_name = $oldManagerData['first_name'];
        $member->last_name = $oldManagerData['last_name'];
        $member->email = $oldManagerData['email'];
        $member->password = $oldManagerData['password']; // use the manager's password
        $member->profile_picture = $oldManagerData['profile_picture'];
        $member->role = 'member'; // change the role to member
        $member->manager = $manager_id; // assign the new manager's ID
        $member->save();

        // return success message
        return redirect()->back()->with('success', 'Roles have been switched successfully!');
    }

}
