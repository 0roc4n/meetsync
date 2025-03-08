<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Members;
use App\Models\Meetings;
use App\Models\MeetingsApproval;
use App\Models\MeetingsAttendance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\MeetingAddedMail;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ManagerMeetingsController extends Controller
{
    

    public function all(Request $request)
    {
        $manager_id = Auth::guard('manager')->id();

        // get the search query and sort parameter
        $query = $request->input('search');
        $sort = $request->input('sort', 'desc'); // default sort to latest (desc)

        // start the base query
        $meetings_of_cliu = Meetings::where('manager_id', $manager_id)
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'like', "%{$query}%")
                    ->orWhere('notes', 'like', "%{$query}%");
            });

        // handle sorting options
        if ($sort === 'desc') {
            // sort by ID (latest)
            $meetings_of_cliu = $meetings_of_cliu->orderBy('id', 'desc');
        } elseif ($sort === 'asc') {
            // sort by ID (oldest)
            $meetings_of_cliu = $meetings_of_cliu->orderBy('id', 'asc');
        } elseif ($sort === 'title') {
            // sort by title (alphabetical)
            $meetings_of_cliu = $meetings_of_cliu->orderBy('title', 'asc');
        }

        // execute the query
        $meetings_of_cliu = $meetings_of_cliu->get();

        return view('manager.meetings', compact('meetings_of_cliu'));
    }




    public function pending(Request $request)
    {
        $manager_id = Auth::guard('manager')->id();

        // get the search query and sort parameter
        $query = $request->input('search');
        $sort = $request->input('sort', 'desc'); // default sort to latest (desc)

        // start the base query
        $meetings_of_cliu = Meetings::where('manager_id', $manager_id)
            ->where('status', 'Pending')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'like', "%{$query}%")
                    ->orWhere('notes', 'like', "%{$query}%");
            });

        // handle sorting options
        if ($sort === 'desc') {
            // sort by ID (latest)
            $meetings_of_cliu = $meetings_of_cliu->orderBy('id', 'desc');
        } elseif ($sort === 'asc') {
            // sort by ID (oldest)
            $meetings_of_cliu = $meetings_of_cliu->orderBy('id', 'asc');
        } elseif ($sort === 'title') {
            // sort by title (alphabetical)
            $meetings_of_cliu = $meetings_of_cliu->orderBy('title', 'asc');
        }

        // execute the query
        $meetings_of_cliu = $meetings_of_cliu->get();

        return view('manager.meetings', compact('meetings_of_cliu'));
    }




    public function done(Request $request)
    {
        $manager_id = Auth::guard('manager')->id();

        // get the search query and sort parameter
        $query = $request->input('search');
        $sort = $request->input('sort', 'desc'); // default sort to latest (desc)

        // start the base query
        $meetings_of_cliu = Meetings::where('manager_id', $manager_id)
            ->where('status', 'Done')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'like', "%{$query}%")
                    ->orWhere('notes', 'like', "%{$query}%");
            });

        // handle sorting options
        if ($sort === 'desc') {
            // sort by ID (latest)
            $meetings_of_cliu = $meetings_of_cliu->orderBy('id', 'desc');
        } elseif ($sort === 'asc') {
            // sort by ID (oldest)
            $meetings_of_cliu = $meetings_of_cliu->orderBy('id', 'asc');
        } elseif ($sort === 'title') {
            // ssort by title (alphabetical)
            $meetings_of_cliu = $meetings_of_cliu->orderBy('title', 'asc');
        }

        // execute the query
        $meetings_of_cliu = $meetings_of_cliu->get();

        return view('manager.meetings', compact('meetings_of_cliu'));
    }



    

    public function add_meeting(Request $request)
    {
        // validate input
        $request->validate([
            'meeting_title' => 'required|string|max:255',
            'meeting_location' => 'required|string|max:255',
            'meeting_agenda' => 'required|string|max:255',
            'meeting_date' => 'required|date',
            'meeting_time' => 'required',
            'invited_members' => 'array', // ensure it's an array
        ]);

        // check for duplicate meeting title
        if (Meetings::where('title', $request->input('meeting_title'))->exists()) {
            return redirect('/meetings')->with('error_message', 'Meeting title already exists. Please choose a different title.');
        }

        // check for date-time conflict
        if (Meetings::where('date', $request->input('meeting_date'))
            ->where('time', $request->input('meeting_time'))->exists()) {
            return redirect('/meetings')->with('error_message', 'A meeting is already scheduled at this date and time.');
        }

        // get invited members from request
        $invited_members = $request->input('invited_members', []);

        // prepare a string to store ids and names
        $invited_members_str = '';
        foreach ($invited_members as $member_name) {
            // retrieve member based on first and last name
            $member = Members::whereRaw("CONCAT(first_name, ' ', last_name) = ?", [$member_name])->first();
            if ($member) {
                // store id:name in the string, separate by semicolon
                $invited_members_str .= $member->id . ':' . $member->first_name . ' ' . $member->last_name . ';';
            }
        }

        // trim the last semicolon
        $invited_members_str = rtrim($invited_members_str, ';');

        // prepare meeting data
        $meeting_info = [
            'title' => $request->input('meeting_title'),
            'location' => $request->input('meeting_location'),
            'agenda' => $request->input('meeting_agenda'),
            'date' => $request->input('meeting_date'),
            'time' => $request->input('meeting_time'),
            'status' => $request->input('meeting_status', "Pending"),
            'notes' => $request->input('meeting_notes', "This is where your meeting minutes or notes will appear."),
            'manager_id' => Auth::id(),
            'invited_members' => $invited_members_str, // store invited members as a string with semicolons
        ];

        // create meeting
        $meeting = Meetings::create($meeting_info);

        // send emails ONLY to invited members
        foreach ($invited_members as $member_name) {
            // retrieve member based on first and last name
            $member = Members::whereRaw("CONCAT(first_name, ' ', last_name) = ?", [$member_name])->first();
            if ($member) {
                // send email to the member
                $meeting_details = [
                    'title' => $request->input('meeting_title'),
                    'location' => $request->input('meeting_location'),
                    'agenda' => $request->input('meeting_agenda'),
                    'date' => $request->input('meeting_date'),
                    'time' => $request->input('meeting_time'),
                    'notes' => $request->input('meeting_notes'),
                ];
                $manager_name = Auth::guard('manager')->user()->first_name . ' ' . Auth::guard('manager')->user()->last_name;
                $organization_name = Auth::guard('manager')->user()->organizations_name;

                Mail::to($member->email)->send(new MeetingAddedMail($meeting_details, $manager_name, $organization_name));
            }
        }

        return redirect('/meetings')->with('success_message', 'Meeting added successfully! Emails are sent to invited members.');
    }








    public function edit_notes($id)
    {
        // get the meeting info by its ID
        $meeting_info = Meetings::findOrFail($id);

        // get the logged-in manager's ID
        $manager_id = Auth::guard('manager')->id();
        $user = Auth::user();

        // get all members associated with this manager
        $members = \App\Models\Members::where('manager', $manager_id)->get();

        // get the member IDs who approved this meeting
        $approved_member_ids = MeetingsApproval::where('meeting_id', $id)
                                                ->pluck('member_id'); // get only member_ids who approved

        // get the details of those members (first_name, last_name, etc.)
        $approved_members = \App\Models\Members::whereIn('id', $approved_member_ids)->get();

        // get the list of attendees (members who are present) for the current meeting
        $attendees = MeetingsAttendance::where('meeting_id', $id)->get();

        // extract the IDs of attendees
        $existing_attendees = $attendees->pluck('member_id')->toArray();

        // process invited members from the meeting (IDs and Names)
        // for storing: example : "ID:Name" => "34:Harry Styles;35:Jeff Azoff;36:Annie Winters"
        $invited_member_ids = explode(';', $meeting_info->invited_members); // contains "ID:Name"
        $invited_members = \App\Models\Members::whereIn('id', array_map(function($item) {
            return explode(':', $item)[0]; // extract only IDs
        }, $invited_member_ids))->get();

        // filter out members who have already attended (remove name from the modal)
        $members_to_display = $invited_members->whereNotIn('id', $existing_attendees);

        // pass the meeting info, members, approved members, and other data to the view
        return view('manager.notes', compact('meeting_info', 'members', 'approved_members', 'attendees', 'existing_attendees', 'members_to_display', 'user'));
    }








    public function manager_convert_to_pdf($id)
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
        $pdf = Pdf::loadView('manager.pdf', $data);

        // set pdf file name based on the meeting title
        $file_name = str_replace(' ', '_', $meeting->title) . '.pdf';

        // return PDF for download with the meeting name
        return $pdf->download($file_name);
    }





    public function delete_meeting($id)
    {
        $meeting = Meetings::findOrFail($id);
        $meeting->delete();

        return redirect('/meetings')->with('success_message', 'Meeting notes deleted successfully!');
    }



    
    public function update_meeting(Request $request, $id)
    {
        // ensure only managers can access this 
        $user = auth()->guard('manager')->user();

        $meeting_info = Meetings::findOrFail($id);
        $meeting_info->notes = $request->input('notes');
        $meeting_info->save();

        return redirect('/edit_notes/' . $id)->with('success_message', 'Meeting notes updated successfully!');
    }




    public function meetings_attendance(Request $request, $meeting_id)
    {
        // validate members input
        $request->validate([
            'attendees' => 'required|array',
            'attendees.*' => 'exists:members_info,id',  
        ]);

        // loop through the attendees and save them
        foreach ($request->attendees as $member_id) {
            // find the member in the 'members_info' table
            $member = Members::find($member_id); 

            if ($member) {
                // create a new entry in the 'meetings_approval' table
                MeetingsAttendance::create([
                    'meeting_id' => $meeting_id,
                    'member_id' => $member->id,
                    'member_name' => $member->first_name . ' ' . $member->last_name,
                ]);
            }
        }
        
        return redirect('/edit_notes/' . $meeting_id)->with('success_message', 'Attendance recorded successfully.');
    }




    public function archive_meeting($id)
    {
        // find the meeting by ID
        $meeting = Meetings::find($id);

        if (!$meeting) {
            return redirect()->back()->with('error_message', 'Meeting not found.');
        }

        // update the status to "done"
        $meeting->update(['status' => 'Done']);

       return redirect('/meetings')->with('success_message', 'Meeting archived successfully.');
    }


    
}
