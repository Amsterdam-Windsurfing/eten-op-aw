<?php

namespace App\Http\Controllers;

use App\Http\Requests\DinnerEventRequest;
use App\Mail\DinnerEventConfirm;
use App\Models\DinnerEvent;
use App\Util\WednesdaysForDinnerEvents;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class DinnerEventController extends Controller
{
    public function index() {
        abort(404);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\DinnerEventRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DinnerEventRequest $request)
    {
        $nextWednesdays = WednesdaysForDinnerEvents::getWednesdaysForDinnerEvents(1);
        $nextWednesday = $nextWednesdays[0];

        $createdDinnerEvent = DinnerEvent::create([
            "date" => $nextWednesdays[0]["date"]->toDate(),
            ...$request->validated()]);

        // Send confirm email
        $confirmUrl = URL::signedRoute('confirmDinnerEvent', ['id' => $createdDinnerEvent->id]);
        Mail::to($createdDinnerEvent->cook_email)->send(new DinnerEventConfirm($createdDinnerEvent, $confirmUrl));

        $cookName = $createdDinnerEvent->cook_name;
        return view('dinner-events.created', compact('nextWednesday', 'cookName'));

    }

    /**
     * Confirms a dinner event.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $dinnerEvent = DinnerEvent::findOrFail($id);

        // check if there is not already a verified dinner event for this date
        $existingEvent = DinnerEvent::where('date', $dinnerEvent["date"]->format('Y-m-d'))->whereNotNull('event_verified_at')->first();

        if ($existingEvent && $existingEvent->id !== $dinnerEvent->id) {
            return view('dinner-events.confirm_error', compact('dinnerEvent'));
        }

        $dinnerEvent->update([
            'event_verified_at' => now(),
        ]);

        return view('dinner-events.confirmed', compact('dinnerEvent'));
    }
}
