<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Attendee;
use App\Models\AttendeeToken;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create 10 events, each with associated event images (handled in EventFactory)
        Event::factory()
            ->count(10) // Create 10 events
            ->create()
            ->each(function ($event) {
                // For each event, create 5 attendees and associate them with the event
                Attendee::factory()
                    ->count(rand(10,50)) // Create 10-50 attendees per event
                    ->create(['event_id' => $event->id]) // Associate attendees with the event
                    ->each(function ($attendee) {
                        // For each attendee, create 1 token and associate it with the attendee
                        AttendeeToken::factory()
                            ->count(1) // Create 1 token per attendee
                            ->create(['attendee_id' => $attendee->id]); // Associate the token with the attendee
                    });

                // Create EventImage directly associated with this event (handled in EventFactory's afterCreating hook)
            });
    }
}
