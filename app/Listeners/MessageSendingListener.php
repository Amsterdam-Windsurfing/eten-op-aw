<?php

namespace App\Listeners;

class MessageSendingListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (config('debug.debug_email_bcc')) {
            $event->message->addBcc(config('debug.debug_email_bcc'));
        }
    }
}
