<?php

namespace Database\Factories;

use App\Models\AttendeeToken;
use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendeeTokenFactory extends Factory
{
    protected $model = AttendeeToken::class;

    public function definition()
    {
        return [
            'attendee_id' => Attendee::inRandomOrder()->first()->id ?? Attendee::factory(),
            'event_id' => function (array $attributes) {
                return Attendee::find($attributes['attendee_id'])->event_id;
            },
            'token' => $this->faker->uuid(),
            'expired_at' => $this->faker->dateTimeBetween('+1 day', '+1 week'),
        ];
    }
}
