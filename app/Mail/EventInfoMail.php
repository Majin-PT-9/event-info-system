<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventInfoMail extends Mailable
{
    use Queueable, SerializesModels;

    public Event $event;
    public \App\Models\Address $eventAddress;

    public \Illuminate\Database\Eloquent\Collection $users;
    /**
     * Create a new message instance.
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
        $this->eventAddress = $event->address()->first();
        $this->users = $event->users()->get();
    }

    /**
     * Get the message envelope.
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('hello@example.com', 'EIS'),
            subject: 'EIS - '. $this->event->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.EventInfoMail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
