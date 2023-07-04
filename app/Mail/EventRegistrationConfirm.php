<?php

namespace App\Mail;

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
    public function __construct(EventRegistration $eventRegistration, $confirmUrl)
    {
        $this->eventRegistration = $eventRegistration;
        $this->confirmUrl = $confirmUrl;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $eventRegistration = $this->eventRegistration;
        $confirmUrl = $this->confirmUrl;

        return $this
            ->subject('Bevestig je aanmelding voor het eten')
            ->text('emails.event-registrations.confirm', compact('eventRegistration', 'confirmUrl'));
    }
}
