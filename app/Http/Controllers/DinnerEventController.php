<?php

namespace App\Http\Controllers;

use App\Http\Requests\DinnerEventRequest;
use App\Models\DinnerEvent;
use App\Util\WednesdaysForDinnerEvents;

class DinnerEventController extends Controller
{
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

        $createdDinnerEvent = DinnerEvent::create(["date" => $nextWednesdays[0]["date"]->toDate(), ...$request->validated()]);

        $cookName = $createdDinnerEvent->cook_name;

        return view('dinner-events.created', compact('nextWednesday', 'cookName'));

    }

    /**
     * Confirms a dinner event.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm()
    {
        return [];
    }
}
