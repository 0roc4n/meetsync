<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{


    public function saveMessage(Request $request)
    {
        $validated = $request->validate([
            'meetingId' => 'required|integer',
            'managerId' => 'required|integer',
            'senderName' => 'required|string',
            'content' => 'required|string'
        ]);

        $message = Message::create([
            'meeting_id' => $validated['meetingId'],
            'manager_id' => $validated['managerId'],
            'sender_name' => $validated['senderName'],
            'content' => $validated['content']
        ]);

        return response()->json(['message' => 'Message saved successfully', 'data' => $message]);
    }

    

    public function fetchMessages(Request $request)
    {
        $messages = Message::where('meeting_id', $request->meetingId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }
}
