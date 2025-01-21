<?php

namespace App\Listeners;

use App\Events\UserRepliedEvent;
use App\Models\Admin;
use App\Notifications\UserReplied;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendUserReplyNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRepliedEvent $event): void
    {
        $admins = Admin::all();
        $attendee = $event->attendee;
        Notification::send($admins, new UserReplied($attendee));
    }
}
