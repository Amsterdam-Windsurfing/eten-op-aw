<?php

namespace App\Util;

use App\Models\DinnerEvent;
use Carbon\Carbon;

class WednesdaysForDinnerEvents {

    public static function getWednesdaysForDinnerEvents($count) {
        $nextWednesdays = [];
        for ($i = 0; $i < $count; $i++) {
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
                    $date["dinnerEvent"] = $nextDinnerEvent;
                }
            }
            $nextWednesdays[$key] = $date;
        }

        return $nextWednesdays;
    }
}
