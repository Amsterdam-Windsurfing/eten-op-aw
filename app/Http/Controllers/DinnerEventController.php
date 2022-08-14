<?php

namespace App\Http\Controllers;

use App\Http\Requests\DinnerEventRequest;
use App\Http\Requests\UpdateDinnerEventRequest;
use App\Models\DinnerEvent;
use Carbon\Carbon;

class DinnerEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dinnerEvents = DinnerEvent::orderBy('date', 'DESC')->take(50)->get();

        return view('dinner-events.index', compact('dinnerEvents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // generate a list of the next 10 Wednesdays with there availability to create a new event
        $nextWednesdays = [];
        for ($i = 0; $i < 10; $i++) {
            $nextWednesday = strtotime("+". $i . " week Wednesday");
            $nextWednesdays[] = [
                "date" => $nextWednesday,
                "formValue" => date("Y-m-d", $nextWednesday),
                "available" => true
            ];
        }

        // query all the dinner events for the date range
        $minDate = date('Y-m-d', $nextWednesdays[0]["date"]);
        $maxDate = date('Y-m-d', $nextWednesdays[array_key_last($nextWednesdays)]["date"]);
        $nextDinnerEvents = DinnerEvent::whereNotNull('event_verified_at')->whereBetween("date", [$minDate, $maxDate])->get();

        // loop over the dates and check if there is a dinner event for that date
        foreach ($nextWednesdays as $key => $date) {
            foreach ($nextDinnerEvents as $nextDinnerEvent) {
                if ($nextDinnerEvent->date->isSameDay(Carbon::createFromTimestamp($date["date"]))) {
                    $date["available"] = false;
                    $date["cookName"] = $nextDinnerEvent->cook_name;
                }
            }
            $nextWednesdays[$key] = $date;
        }

        return view('dinner-events.create', compact('nextWednesdays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DinnerEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DinnerEventRequest $request)
    {
        $createdDinnerEvent = DinnerEvent::create($request->validated());

        // dinner events created by admin users are automatically verified
        $createdDinnerEvent->event_verified_at = Carbon::now();
        $createdDinnerEvent->save();

        return redirect()->route('dinner-events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DinnerEvent  $dinnerEvent
     * @return \Illuminate\Http\Response
     */
    public function show(DinnerEvent $dinnerEvent)
    {
        return view('dinner-events.show', compact('dinnerEvent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DinnerEvent  $dinnerEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(DinnerEvent $dinnerEvent)
    {
        return view('dinner-events.edit', compact('dinnerEvent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DinnerEventRequest  $request
     * @param  \App\Models\DinnerEvent  $dinnerEvent
     * @return \Illuminate\Http\Response
     */
    public function update(DinnerEventRequest $request, DinnerEvent $dinnerEvent)
    {
        $dinnerEvent->update($request->validated());

        return redirect()->route('dinner-events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DinnerEvent  $dinnerEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(DinnerEvent $dinnerEvent)
    {
        $dinnerEvent->delete();

        return redirect()->route('dinner-events.index');
    }
}
