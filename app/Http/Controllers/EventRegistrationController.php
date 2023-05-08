<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRegistrationRequest;
use App\Mail\EventRegistrationConfirm;
use App\Models\EventRegistration;
use App\Util\WednesdaysForDinnerEvents;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class EventRegistrationController extends Controller
{
    public function index() {
        abort(404);
    }
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

        $eventRegistration = EventRegistration::create([
            "dinner_event_id" => $dinnerEvent->id,
            "registration_verified_at" => $emailVerifiedBefore ? now() : null,
            ...$request->validated()
        ]);

        if (!$emailVerifiedBefore) {
            // Send confirm email
            $confirmUrl = URL::signedRoute('confirmEventRegistration', ['id' => $eventRegistration->id]);
            Mail::to($eventRegistration->email)->send(new EventRegistrationConfirm($eventRegistration, $confirmUrl));
        }


        return view('event-registrations.created', compact('eventRegistration'));
    }


    /**
     * Confirms an event registration.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $eventRegistration = EventRegistration::findOrFail($id);

        if ($eventRegistration->dinnerEvent->registration_deadline < now()) {
            return view('event-registrations.confirm_error', compact('eventRegistration'));
        }

        $eventRegistration->update([
            'registration_verified_at' => now(),
        ]);

        return view('event-registrations.confirmed', compact('eventRegistration'));
    }
}
