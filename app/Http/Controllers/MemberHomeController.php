<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MemberNotifications1;
use Carbon\Carbon;

class MemberHomeController extends Controller
{

    public function member_home()
    {
        // get the currently logged-in member
        $member = Auth::guard('member')->user();

        // get the latest notification for the logged-in member
        $notification = MemberNotifications1::where('member_id', $member->id)
                                            ->orderBy('time', 'desc')
                                            ->first();

        return view('member.home', [
            'notification' => $notification,  // pass the notification to the view
            'info' => $member,  // pass member details to the view
        ]);
    }


}
