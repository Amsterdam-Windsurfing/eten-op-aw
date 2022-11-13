<?php

namespace App\Util;

use App\Models\DinnerEvent;
use Carbon\Carbon;

class WednesdaysForDinnerEvents {

    public static function getWednesdaysForDinnerEvents($count) {
        $nextWednesdays = [];
        for ($i = 0; $i < $count; $i++) {
            $nextWednesday = \Carbon\Carbon::now()->startOfDay()->subDays(1)->next('Wednesday')->addWeeks($i);
            $nextWednesdays[] = [
                "date" => $nextWednesday,
                "formValue" => $nextWednesday->format("Y-m-d"),
                "available" => true,
                "dinnerEvent" => null
            ];
        }

        // query all the dinner events for the date range
        $minDate = $nextWednesdays[0]["date"]->format("Y-m-d");
        $maxDate = $nextWednesdays[array_key_last($nextWednesdays)]["date"]->format("Y-m-d");
        $nextDinnerEvents = DinnerEvent::whereNotNull('event_verified_at')->whereBetween("date", [$minDate, $maxDate])->get();

        // loop over the dates and check if there is a dinner event for that date
        foreach ($nextWednesdays as $key => $date) {
            foreach ($nextDinnerEvents as $nextDinnerEvent) {
                if ($nextDinnerEvent->date->isSameDay($date["date"])) {
                    $date["available"] = false;
                    $date["cookName"] = $nextDinnerEvent->cook_name;
                    $date["dinnerEvent"] = $nextDinnerEvent;
                }
            }
            $nextWednesdays[$key] = $date;
        }

        ray(Carbon::now()->format('Y-m-d H:i:s'));
        ray('Next wedn');
        ray($nextWednesdays);

        return $nextWednesdays;
    }
}
