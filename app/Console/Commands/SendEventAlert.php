<?php

namespace App\Console\Commands;

use App\Jobs\SendEventInformation;
use App\Mail\EventInfoMail;
use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEventAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email 3 days prior to an event start date';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $futureDate = now()->addDays(3)->startOfDay();
            $events = Event::whereDate('starts_at', $futureDate)->get();
            foreach ($events as $event) {
                SendEventInformation::dispatch($event);
            }
        }catch (\Error $e){
            $this->error($e->getMessage());
        }
        catch (\Exception $e){
            $this->error($e->getMessage());
        }
        $this->info('Alert emails queued successfully.');
    }
}
