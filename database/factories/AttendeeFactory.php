<?php

namespace Database\Factories;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendeeFactory extends Factory
{
    protected $model = Attendee::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'entity' => $this->faker->company(),
            // The event_id will be set later in the `afterCreating` method
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Attendee $attendee) {
            // Get a random event and assign the event_id to the attendee
            $event = Event::inRandomOrder()->first();
            $attendee->event_id = $event->id;  // Set event_id for the attendee
            $attendee->save();

            // Generate a random confirmation status
            $confirmation = $this->faker->randomElement(['confirmed', 'pending', 'declined']);
            // If declined, generate a reason
            $reason = $confirmation === 'declined' ? $this->faker->sentence() : null;

            // Attach the event to the attendee with the pivot data
            $attendee->events()->attach($event->id, [
                'confirmation' => $confirmation,
                'reason' => $reason,
            ]);
        });
    }
}
