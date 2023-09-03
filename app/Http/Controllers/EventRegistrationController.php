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
    public function index()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EventRegistrationRequest $request)
    {
        $nextWednesdays = WednesdaysForDinnerEvents::getWednesdaysForDinnerEvents(1);
        $dinnerEvent = $nextWednesdays[0]['dinnerEvent'];

        $emailVerifiedBefore = EventRegistration::where('email', $request->post('email'))->whereNotNull('registration_verified_at')->count();

        $eventRegistration = EventRegistration::create([
            'dinner_event_id' => $dinnerEvent->id,
            'registration_verified_at' => $emailVerifiedBefore ? now() : null,
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'dinner_option' => $request->validated('dinner_option'),
            'allergies' => $request->validated('allergies'),
            'after_training' => $request->boolean('after_training'),
        ]);

        if ($request->validated('plus_one')) {
            // also create any plus one records
            foreach ($request->validated('plus_one') as $key => $plusOne) {
                EventRegistration::create([
                    'dinner_event_id' => $dinnerEvent->id,
                    'registration_verified_at' => $emailVerifiedBefore ? now() : null,
                    'name' => $plusOne['name'],
                    'email' => $request->validated('email'),
                    'dinner_option' => $plusOne['dinner_option'],
                    'allergies' => $plusOne['allergies'],
                    'after_training' => $request->boolean('plus_one.' . $key . '.after_training'),
                    'plus_one' => $key + 1,
                ]);
            }
        }

        if (! $emailVerifiedBefore) {
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

        // simple return the successful verified message if already verified
        if ($eventRegistration->registration_verified_at) {
            return view('event-registrations.confirmed', compact('eventRegistration'));
        }

        if ($eventRegistration->dinnerEvent->registration_deadline < now()) {
            return view('event-registrations.confirm_error', compact('eventRegistration'));
        }

        $eventRegistration->update([
            'registration_verified_at' => now(),
        ]);

        // lookup any linked plus one records and set as verified
        $plusOneEventRegistrations = EventRegistration::where('email', $eventRegistration->email)
            ->where('dinner_event_id', $eventRegistration->dinner_event_id)
            ->get();

        foreach ($plusOneEventRegistrations as $plusOneEventRegistration) {
            $plusOneEventRegistration->update([
                'registration_verified_at' => now(),
            ]);
        }

        return view('event-registrations.confirmed', compact('eventRegistration'));
    }
}
