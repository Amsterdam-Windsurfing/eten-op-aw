<?php

namespace App\Mail;

use App\Models\DinnerEvent;
use App\Util\EventRegistrationsPDFRenerator;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DinnerEventRegistrationClosed extends Mailable
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
        // create PDF file
        $pdf = new EventRegistrationsPDFRenerator($this->dinnerEvent, resource_path() . "/images/logo.png");

        $dinnerEvent = $this->dinnerEvent;

        return $this->text('emails.dinner-events.registration-closed', compact('dinnerEvent'))
            ->attachData($pdf->getDocumentAsString(),'Registratielijst_' . $this->dinnerEvent->id . '.pdf', [
                'mime' => 'application/pdf',
        ]);
    }
}
