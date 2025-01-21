<?php

namespace App\Console\Commands;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DisableFinishedEventCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable Finished Events';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::where('status', 'active')
                ->where('end_date_time', '<=', Carbon::now()->toDateTimeString())
                ->get();
        $bar = $this->output->createProgressBar(count($events));
        $bar->start();

        foreach ($events as $event) {
            $event->status = "completed";
            $event->save();
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info('All Finished Events Disabled Successfully.');
    }
}
