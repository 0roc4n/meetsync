<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Members;
use App\Models\Meetings;
use App\Models\MeetingsApproval;
use App\Models\MeetingsAttendance;
use App\Models\ManagerNotifications;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MemberMeetingsController extends Controller
{



    public function member_meetings(Request $request)
    {
        // get the logged-in member
        $member = Auth::guard('member')->user();
        $member_id = $member->id; // Use member's ID instead of name

        // get the manager's ID from the member's record
        $manager_id = $member->manager; // "manager" column in members model

        // get the search query and sort parameter
        $search = $request->input('search');
        $sort = $request->input('sort', 'desc'); // default sort to latest (desc)

        // start the base query
        $meetings_of_manager = Meetings::where('manager_id', $manager_id)
            ->where(function($query) use ($member_id) {
                // Check if the member ID is in the 'invited_members' column
                $query->where('invited_members', 'like', "%{$member_id}%");
            })
            ->where(function ($queryBuilder) use ($search) {
                if ($search) {
                    $queryBuilder->where('title', 'like', "%{$search}%")
                        ->orWhere('notes', 'like', "%{$search}%");
                }
            });

        // handle sorting options
        if ($sort === 'desc') {
            $meetings_of_manager = $meetings_of_manager->orderBy('id', 'desc');
        } elseif ($sort === 'asc') {
            $meetings_of_manager = $meetings_of_manager->orderBy('id', 'asc');
        } elseif ($sort === 'title') {
            $meetings_of_manager = $meetings_of_manager->orderBy('title', 'asc');
        }

        // execute the query
        $meetings_of_manager = $meetings_of_manager->get();
        

        // return the view with the filtered meetings
        return view('member.meetings', compact('meetings_of_manager'));
    }







    public function member_meetings_pending(Request $request)
    {
        // get the logged-in member
        $member = Auth::guard('member')->user();
        $member_id = $member->id; // Use member's ID instead of name

        // get the manager's ID from the member's record
        $manager_id = $member->manager; // "manager" column in members model

        // get the search query and sort parameter
        $search = $request->input('search');
        $sort = $request->input('sort', 'desc'); // default sort to latest (desc)

        // start the base query
        $meetings_of_manager = Meetings::where('manager_id', $manager_id)
            ->where('status', 'Pending') // filter only 'Pending' meetings
            ->where(function($query) use ($member_id) {
                // Check if the member ID is in the 'invited_members' column
                $query->where('invited_members', 'like', "%{$member_id}%");
            })
            ->where(function ($queryBuilder) use ($search) {
                if ($search) {
                    $queryBuilder->where('title', 'like', "%{$search}%")
                        ->orWhere('notes', 'like', "%{$search}%");
                }
            });
        // handle sorting options
        if ($sort === 'desc') {
            $meetings_of_manager = $meetings_of_manager->orderBy('id', 'desc');
        } elseif ($sort === 'asc') {
            $meetings_of_manager = $meetings_of_manager->orderBy('id', 'asc');
        } elseif ($sort === 'title') {
            $meetings_of_manager = $meetings_of_manager->orderBy('title', 'asc');
        }

        // execute the query
        $meetings_of_manager = $meetings_of_manager->get();

        // return the view with the filtered meetings
        return view('member.meetings', compact('meetings_of_manager'));
    }






    public function member_meetings_done(Request $request)
    {
        // get the logged-in member
        $member = Auth::guard('member')->user();
        $member_id = $member->id; // Use member's ID instead of name

        // get the manager's ID from the member's record
        $manager_id = $member->manager; // "manager" column in members model

        // get the search query and sort parameter
        $search = $request->input('search');
        $sort = $request->input('sort', 'desc'); // default sort to latest (desc)

        // start the base query
        $meetings_of_manager = Meetings::where('manager_id', $manager_id)
            ->where('status', 'Done') // filter only 'Done' meetings
            ->where(function($query) use ($member_id) {
                // Check if the member ID is in the 'invited_members' column
                $query->where('invited_members', 'like', "%{$member_id}%");
            })
            ->where(function ($queryBuilder) use ($search) {
                if ($search) {
                    $queryBuilder->where('title', 'like', "%{$search}%")
                        ->orWhere('notes', 'like', "%{$search}%");
                }
            });

        // handle sorting options
        if ($sort === 'desc') {
            $meetings_of_manager = $meetings_of_manager->orderBy('id', 'desc');
        } elseif ($sort === 'asc') {
            $meetings_of_manager = $meetings_of_manager->orderBy('id', 'asc');
        } elseif ($sort === 'title') {
            $meetings_of_manager = $meetings_of_manager->orderBy('title', 'asc');
        }

        // execute the query
        $meetings_of_manager = $meetings_of_manager->get();

        // return the view with the filtered meetings
        return view('member.meetings', compact('meetings_of_manager'));
    }




    public function edit_notes_member($id)
    {
        $meeting_info = Meetings::findOrFail($id);
        $user = Auth::user();
        return view('member.notes', compact('meeting_info', 'user'));
    }



    public function member_convert_to_pdf($id)
    {
        // get meeting details
        $meeting = Meetings::findOrFail($id);

        // get members who attended this meeting
        $attendees = MeetingsAttendance::where('meeting_id', $id)->pluck('member_name')->toArray();

        // get members who are approve of meeting notes/minutes
        $approvals = MeetingsApproval::where('meeting_id', $id)->pluck('member_name')->toArray();

        // prepare data for pdf
        $data = [
            'title' => $meeting->title,
            'location' => $meeting->location,
            'agenda' => $meeting->agenda,
            'date' => (new \DateTime($meeting->date))->format('F d, Y'),
            'time' => (new \DateTime($meeting->time))->format('h:i A'),
            'notes' => $meeting->notes,
            'attendees' => $attendees, 
            'approvals' => $approvals,
        ];

        // generate pdf
        $pdf = Pdf::loadView('member.pdf', $data);

        // set pdf file name based on the meeting title
        $file_name = str_replace(' ', '_', $meeting->title) . '.pdf';

        // return PDF for download with the meeting name
        return $pdf->download($file_name);
    }





    public function update_meeting_member(Request $request, $id)
    {
        // ensure only members can access this
        $user = auth()->guard('member')->user();

        if (!$user) {
            // if no authenticated member, redirect or show an error
            return redirect()->route('login')->with('error', 'You must be a member to update meeting notes.');
        }

        $meeting_info = Meetings::findOrFail($id);
        $meeting_info->notes = $request->input('notes');
        $meeting_info->save();

        // redirect member after successfully updating meeting notes
        return redirect('/meetingsm')->with('success_message', 'Meeting notes updated successfully!');
    }



    
    public function meeting_approval($meeting_id)
    {
        // get the meeting by its ID
        $meeting = Meetings::findOrFail($meeting_id);

        $meeting_name = $meeting->title;

        // get the currently logged in member's details
        $member = Auth::guard('member')->user();
        $member_id = $member->id;
        $member_name = $member->first_name . ' ' . $member->last_name;
        $manager_id = $member->manager;

        // check if the member already approved the specific meeting
        $existing_approval = MeetingsApproval::where('meeting_id', $meeting_id)
                                            ->where('member_id', $member_id)
                                            ->first();

        if ($existing_approval) {
            // if the member already approved, redirect with a message
            return redirect('/edit_notes_member/' . $meeting_id)->with('error_message', 'You have already approved this meeting.');
        }

        // create the meeting approval record
        MeetingsApproval::create([
            'meeting_id' => $meeting_id,
            'meeting_name' => $meeting_name,
            'member_id' => $member_id,
            'member_name' => $member_name,
            'manager_id' => $manager_id,
        ]);

        // create the manager notification
        ManagerNotifications::create([
            'time' => now(), 
            'meeting_name' => $meeting_name,
            'member_name' => $member_name,
            'manager_id' => $manager_id,
        ]);

        // save the meeting
        $meeting->save();
        
        return redirect('/meetingsm')->with('success_message', 'Meeting got approved!');
    }





}