<?php

namespace App\Http\Controllers;

use App\Util\WednesdaysForDinnerEvents;

class HomeController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nextWednesdays = WednesdaysForDinnerEvents::getWednesdaysForDinnerEvents(1);
        $nextWednesday = $nextWednesdays[0];
        $dinnerEvent = $nextWednesdays[0]["dinnerEvent"];

        $suggestedRegistrationDeadline = $nextWednesday["date"]->copy()->subDays(1)->setTime(22, 0, 0);

        return view('home', compact('nextWednesday', 'dinnerEvent', 'suggestedRegistrationDeadline'));

    }
}
