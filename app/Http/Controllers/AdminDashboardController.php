<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Members;
use App\Models\Meetings;
use App\Models\PendingUser;
use App\Mail\UserAcceptedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{



    public function admin_dashboard()
    {
        // get the count of each model
        $managers_count = Manager::count();
        $members_count = Members::count();
        $meetings_count = Meetings::count();
        $pending_users_count = PendingUser::count();

        // get all pending users
        $pending_users = PendingUser::all();

        // pass the total counts and the pending users to the view
        return view('admin.dashboard', compact(
            'pending_users', 
            'pending_users_count', 
            'managers_count', 
            'members_count', 
            'meetings_count'
        ));
    }



    public function accept_user($id)
    {
        $pending_user = PendingUser::findOrFail($id);

        if ($pending_user->role === 'member') {
            $member = Members::create([
                'first_name' => $pending_user->first_name,
                'middle_name' => $pending_user->middle_name,
                'last_name' => $pending_user->last_name,
                'organizations_name' => $pending_user->organizations_name,
                'email' => $pending_user->email,
                'password' => $pending_user->password,
                'role' => $pending_user->role,
                'profile_picture' => 'profile_pictures/msdefault.jpg',
                'manager' => 0,
            ]);
        
            // Send email notification
            Mail::to($pending_user->email)->send(new UserAcceptedMail($pending_user));
        } else {
            $manager = Manager::create([
                'first_name' => $pending_user->first_name,
                'middle_name' => $pending_user->middle_name,
                'last_name' => $pending_user->last_name,
                'organizations_name' => $pending_user->organizations_name,
                'email' => $pending_user->email,
                'password' => $pending_user->password,
                'role' => $pending_user->role,
                'profile_picture' => 'profile_pictures/msdefault.jpg',
                'manager' => 0,
            ]);
        
            if ($pending_user->role === 'manager') {
                $manager->manager = $manager->id;
                $manager->save();
            }
        
            // Send email notification
            Mail::to($pending_user->email)->send(new UserAcceptedMail($pending_user));
        }

        // delete the pending user record
        $pending_user->delete();

        return redirect()->back()->with('success', 'User accepted! User can now log in.');
    }



    public function reject_user($id)
    {
        $pendingUser = PendingUser::findOrFail($id);
        $pendingUser->delete(); // just delete the record

        return redirect()->back()->with('success', 'User request rejected.');
    }





}

