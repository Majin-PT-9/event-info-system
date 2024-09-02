<?php

namespace App\Jobs;

use App\Mail\EventInfoMail;
use App\Models\Event;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class SendEventInformation implements ShouldQueue
{
    use Queueable;

    public Event $event;
    public Collection $users;

    /**
     * Create a new job instance.
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
        $this->users = $event->users()->get();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //if we wanted to send an email to each user
//            foreach ($this->users as $user) {
//                Mail::to($user->email)->send(new EventInfoMail($this->event));
//            }
            Mail::to(config('mail.mail_to_testing'))->send(new EventInfoMail($this->event));
    }
}
