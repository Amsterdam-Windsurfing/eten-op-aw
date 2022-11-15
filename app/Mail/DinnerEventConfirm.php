<?php

namespace App\Mail;

use App\Models\DinnerEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DinnerEventConfirm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(DinnerEvent $dinnerEvent)
    {
        $this->dinnerEvent = $dinnerEvent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dinnerEvent = $this->dinnerEvent;
        return $this->text('emails.dinner-events.confirm', compact('dinnerEvent'));
    }
}
