<?php

namespace App\Http\Controllers;

use App\Events\UserRepliedEvent;
use App\Models\Admin;
use App\Notifications\UserReplied;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function send(){
        // UserRepliedEvent::dispatch();
    }

    public function getNotifications(){
        $user = Auth::guard('admin')->user();
        return $user->notifications()->latest()->paginate(5);  // Show 5 notifications per page
    }
    
    public function getUnreadNotifications(){
        $user = Auth::guard('admin')->user();
        return $user->unreadNotifications()->latest()->paginate(5);
    }
    public function markAsRead($notification_id)
    {
        $user = Auth::guard('admin')->user();
        $notification = $user->notifications()->findOrFail($notification_id);
        $notification->markAsRead();
        // return $notification;
    }
    public function markAllAsRead(){
        $user = Auth::guard('admin')->user();
        $user->unreadNotifications->markAsRead();
    }
}
