<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the events table
        Event::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Generate sample data
        for ($i = 1; $i <= 10; $i++) {
            Event::create([
                'title' => 'Sample Event ' . $i,
                'location' => 'Location ' . $i,
                'start_date_time' => Carbon::now()->addDays($i),
                'end_date_time' => Carbon::now()->addDays($i)->addHours(3),
                'short_description' => 'This is a short description for Sample Event ' . $i,
                'long_description' => 'This is a long description for Sample Event ' . $i . '. Here you would include more detailed information about the event.',
                'status' => 'active',
                'admin_id' => 1,
            ]);
        }
    }
}

