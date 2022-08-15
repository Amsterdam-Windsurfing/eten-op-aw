<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DinnerEvent;

class DinnerEventController extends Controller
{
    /**
     * Returns a JSON object with the two upcoming dinner events.
     *
     * @return \Illuminate\Http\Response
     */
    public function upcoming()
    {
        return [];
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
