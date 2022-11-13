<?php

namespace App\Http\Controllers;

use App\Util\WednesdaysForDinnerEvents;

class DinnerEventController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get the next two wednesdays
        $nextWednesdays = WednesdaysForDinnerEvents::getWednesdaysForDinnerEvents(2);

        return view('dinner-events.index', compact('nextWednesdays'));
    }

    /**
     * Creates a new dinner event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return [];
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
