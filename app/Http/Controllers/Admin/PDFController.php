<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDinnerEventRequest;
use App\Models\DinnerEvent;
use App\Util\EventRegistrationsPDFRenerator;
use App\Util\PDFGenerator;

class PDFController extends Controller
{
    /**
     *  Download Event Registrations as PDF
     *
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
