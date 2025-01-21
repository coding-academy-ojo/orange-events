<?php

namespace App\Jobs;

use App\Mail\InvitationMail;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendInvitationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $subject;
    public $attendee;
    public $event;
    public $token;


    /**
     * Create a new job instance.
     */
    public function __construct(Event $event, Attendee $attendee, String $token, String $subject = null)
    {
        $this->event = $event;
        $this->attendee = $attendee;
        $this->token = $token;
        $this->subject = $subject ?? $event->title;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->attendee->email)->send(new InvitationMail($this->event, $this->attendee, $this->token));
    }
}
