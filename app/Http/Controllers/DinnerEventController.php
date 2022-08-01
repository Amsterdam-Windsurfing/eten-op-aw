<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDinnerEventRequest;
use App\Http\Requests\UpdateDinnerEventRequest;
use App\Models\DinnerEvent;

class DinnerEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dinnerEvents = DinnerEvent::all();

        return view('dinner-events.index', compact('dinnerEvents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDinnerEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDinnerEventRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DinnerEvent  $dinnerEvent
     * @return \Illuminate\Http\Response
     */
    public function show(DinnerEvent $dinnerEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DinnerEvent  $dinnerEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(DinnerEvent $dinnerEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDinnerEventRequest  $request
     * @param  \App\Models\DinnerEvent  $dinnerEvent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDinnerEventRequest $request, DinnerEvent $dinnerEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DinnerEvent  $dinnerEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(DinnerEvent $dinnerEvent)
    {
        //
    }
}
