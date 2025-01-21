<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Attendee;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch statistics from the database
        $events = Event::with('attendees')->get();
        $eventData = $events->map(function ($event) {
            return [
                'name' => $event->title,
                'date' => $event->start_date_time
            ];
        });
        $all_events = Event::all()->count();
        $active_events = Event::where('status', 'active')->orderBy('created_at', 'desc')->get();
        // $inactive_events = Event::where('status', 'inactive')->get()->count();
        $attendees = Attendee::all()->count();
        $eventNames = $eventData->pluck('name')->toArray();
        $totalEvents = Event::count(); 
        $openEvents = Event::where('status', 'active')->count();
        $closedEvents = $totalEvents - $openEvents;
        $attendeesCount = $events->map(function ($event) {
            return $event->attendees->count(); // Count of attendees for each event
        })->toArray();
        $confirmedAttendeesCount = $events->map(function ($event) {
            return $event->attendees->filter(function ($attendee) {
                return $attendee->confirmation === 'confirmed';
            })->count(); // Count of pending attendees for each event
        })->toArray();
        $declinedAttendeesCount = $events->map(function ($event) {
            return $event->attendees->filter(function ($attendee) {
                return $attendee->confirmation === 'declined';
            })->count(); // Count of pending attendees for each event
        })->toArray();
        $pendingAttendeesCount = $events->map(function ($event) {
            return $event->attendees->filter(function ($attendee) {
                return $attendee->confirmation === 'pending';
            })->count(); // Count of pending attendees for each event
        })->toArray();
        

        return view('dashboard.pages.dashboard', [
            'events' => $events,
            'eventNames' => $eventNames,
            'all_events' => $all_events,
            'attendees' => $attendees,
            'active_events' => $active_events,
            'attendeesCount' => $attendeesCount,
            'confirmedAttendeesCount' => $confirmedAttendeesCount,
            'declinedAttendeesCount' => $declinedAttendeesCount,
            'pendingAttendeesCount' => $pendingAttendeesCount,
            'totalEvents' => $totalEvents,
            'openEvents' => $openEvents,
            'closedEvents' => $closedEvents,
        ]);
    }
}

