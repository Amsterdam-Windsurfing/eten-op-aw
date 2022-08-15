<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRegistrationRequest;
use App\Http\Requests\UpdateEventRegistrationRequest;
use App\Models\EventRegistration;

class EventRegistrationController extends Controller
{
    /**
     * Creates a new event registration.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return [];
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

    /**
     * Cancels an event registration.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        return [];
    }
}
