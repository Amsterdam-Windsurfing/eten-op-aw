<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRegistrationRequest;
use App\Mail\DinnerEventConfirm;
use App\Mail\EventRegistrationConfirm;
use App\Models\EventRegistration;
use App\Util\WednesdaysForDinnerEvents;
use Illuminate\Support\Facades\Mail;

class EventRegistrationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\EventRegistrationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRegistrationRequest $request)
    {
        $nextWednesdays = WednesdaysForDinnerEvents::getWednesdaysForDinnerEvents(1);
        $dinnerEvent = $nextWednesdays[0]["dinnerEvent"];

        $emailVerifiedBefore = EventRegistration::where('email', $request->post('email'))->whereNotNull('registration_verified_at')->count();

        $createdEventRegistration = EventRegistration::create([
            "dinner_event_id" => $dinnerEvent->id,
            "registration_verified_at" => $emailVerifiedBefore ? now() : null,
            ...$request->validated()
        ]);

        // Send confirm email
        Mail::to($createdEventRegistration->email)->send(new EventRegistrationConfirm($createdEventRegistration));

        return view('event-registrations.created', compact('createdEventRegistration'));
    }


    /**
     * Confirms an event registration.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm()
    {
        return [];
    }
}
