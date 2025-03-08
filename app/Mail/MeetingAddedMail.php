<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MeetingAddedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $meeting_details;
    public $email_manager_name;
    public $email_organization_name;

    public function __construct($meeting_details, $full_manager_name, $organization_name)
    {
        $this->meeting_details = $meeting_details;
        $this->email_manager_name = $full_manager_name;
        $this->email_organization_name = $organization_name;
    }

    public function build()
    {
        return $this->subject('New Meeting Added')
                    ->view('manager.meeting_added');
    }
}
