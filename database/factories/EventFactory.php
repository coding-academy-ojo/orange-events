<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'admin_id' => 1,
            'title' => $this->faker->sentence(),
            'location' => $this->faker->address(),
            'start_date_time' => $this->faker->dateTimeBetween('now', '+1 week'),
            'end_date_time' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'short_description' => $this->faker->text(100),
            'long_description' => $this->faker->text(500),
            'status' => $this->faker->randomElement(['active', 'completed']),
            'location_link' => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3516.8711824600755!2d35.912381824223374!3d31.970174174011245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151ca1dd7bca79dd%3A0x9b0416f056ff0786!2sOrange%20Digital%20Village!5e1!3m2!1sar!2sjo!4v1735950055759!5m2!1sar!2sjo",
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Event $event) {
            // Create EventImage associated with this event
            EventImage::create([
                'event_id' => $event->id,
                'image' => "https://orange.jo/sites/default/files/styles/m1640x607/public/2023-10/The%20Studio_Web%20EN.png?itok=Gb_DT-92",
                'path' => 'events/' . $event->id,
            ]);
        });
    }
}
