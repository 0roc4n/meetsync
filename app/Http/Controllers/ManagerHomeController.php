<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Members;
use App\Models\Meetings;
use App\Models\ManagerNotifications;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ManagerHomeController extends Controller
{


    public function manager_home()
    {
        // get the current logged-in manager's ID using custom guard
        $manager_id = Auth::guard('manager')->id(); 

        // get the manager's information
        $manager = Manager::find($manager_id);
        
        // get the total count of members associated with this manager
        $members_count = Members::where('manager', $manager_id)->count(); 

        // count meetings with "done" status associated with the manager
        $done_meetings_count = Meetings::where('manager_id', $manager_id)
            ->where('status', 'done')
            ->count();

        // count meetings with "pending" status associated with the manager
        $pending_meetings_count = Meetings::where('manager_id', $manager_id)
            ->where('status', 'pending')
            ->count();

        // get notifications for the currently logged-in manager
        $notifications = ManagerNotifications::where('manager_id', $manager_id)
                                                ->orderBy('time', 'desc')
                                                ->get(['member_name', 'meeting_name', 'time'])
                                                ->map(function ($notification) {
                                                    $notification->time = Carbon::parse($notification->time)->timezone('Asia/Manila')->toDateTimeString();
                                                    return $notification;
                                                });


        // pass the counts and notifications to the view
        return view('manager.home', compact(
            'members_count', 
            'manager', 
            'done_meetings_count', 
            'pending_meetings_count',
            'notifications'  // pass notifications to the view
        ));
    }

    
    
}
