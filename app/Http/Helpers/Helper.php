<?php

namespace App\Http\Helpers;

use App\Jobs\SendInvitationJob;
use App\Mail\InvitationMail;
use App\Models\AttendeeToken;
use App\Models\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Helper {



  public static function invite($attendee, $event){
    $token = Str::random(60);
    AttendeeToken::create([
      'attendee_id' => $attendee->id,
      'event_id' => $event->id,
      'token' => $token,
      'expired_at' => $event->end_date_time,
    ]);

    // Mail::to($attendee->email)->send(new InvitationMail($event, $attendee, $token));
    SendInvitationJob::dispatch($event, $attendee, $token);
  }

}