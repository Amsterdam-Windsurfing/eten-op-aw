<?php

namespace App\Http\Controllers;

use App\Http\Requests\DinnerEventRequest;
use App\Http\Requests\UpdateDinnerEventRequest;
use App\Models\DinnerEvent;
use App\Util\EventRegistrationsPDFRenerator;
use App\Util\PDFGenerator;
use Carbon\Carbon;

class PDFController extends Controller
{
    /**
     *  Download Event Registrations as PDF
     *
     * @param  \App\Models\DinnerEvent  $dinnerEvent
     * @return \Illuminate\Http\Response
     */
    public function eventRegistrations($id)
    {
        $dinnerEvent = DinnerEvent::findOrFail($id);

        // create PDF file
        $pdf = new EventRegistrationsPDFRenerator($dinnerEvent, resource_path() . "/images/logo.png");

        return $pdf->getDocument();
    }
}
