<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class EventUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $updatedEvent;
    public $adminName;
    public function __construct($updatedEvent, $adminName)
    {
        $this->updatedEvent = $updatedEvent;
        $this->adminName = $adminName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $eventTitle = $this->updatedEvent['title'];
        return [
            'title' => "Event '{$eventTitle}' Updated by Admin '{$this->adminName}'"
        ];
    }
}
