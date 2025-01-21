<?php

namespace App\Listeners;

use App\Events\EventUpdated;
use App\Models\Admin;
use App\Notifications\EventUpdatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class SendEventUpdatedNotification
{
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(EventUpdated $event): void
    {
        $admins = Admin::where('id', '!=', Auth::guard('admin')->user()->id)->get();
        $adminName = Auth::guard('admin')->user()->full_name;
        Notification::send($admins, new EventUpdatedNotification($event->updatedEvent, $adminName));
    }
}