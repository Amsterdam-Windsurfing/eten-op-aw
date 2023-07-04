<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DinnerEventRequest;
use App\Models\DinnerEvent;
use App\Util\WednesdaysForDinnerEvents;
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

        return view('admin.dinner-events.index', compact('dinnerEvents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // generate a list of the next 10 Wednesdays with there availability to create a new event
        $nextWednesdays = WednesdaysForDinnerEvents::getWednesdaysForDinnerEvents(10);

        return view('admin.dinner-events.create', compact('nextWednesdays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DinnerEventRequest $request)
    {
        // dinner events created by admin users are automatically verified
        $createdDinnerEvent = DinnerEvent::create(['event_verified_at' => Carbon::now(), ...$request->validated()]);

        return redirect()->route('admin.dinner-events.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(DinnerEvent $dinnerEvent)
    {
        return view('admin.dinner-events.show', compact('dinnerEvent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(DinnerEvent $dinnerEvent)
    {
        return view('admin.dinner-events.edit', compact('dinnerEvent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DinnerEventRequest $request, DinnerEvent $dinnerEvent)
    {
        $dinnerEvent->update($request->validated());

        return redirect()->route('admin.dinner-events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(DinnerEvent $dinnerEvent)
    {
        $dinnerEvent->delete();

        return redirect()->route('admin.dinner-events.index');
    }
}
