<?php

namespace App\Mail;

use App\Models\DinnerEvent;
use App\Models\EventRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventRegistrationConfirm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EventRegistration $eventRegistration)
    {
        $this->eventRegistration = $eventRegistration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $eventRegistration = $this->eventRegistration;
        return $this->text('emails.event-registrations.confirm', compact('eventRegistration'));
    }
}
