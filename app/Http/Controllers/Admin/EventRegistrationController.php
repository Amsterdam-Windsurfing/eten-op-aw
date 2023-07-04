<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventRegistration;

class EventRegistrationController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventRegistration $eventRegistration)
    {
        $eventRegistration->delete();

        return redirect()->route('admin.dinner-events.show', $eventRegistration->dinner_event_id);
    }
}
