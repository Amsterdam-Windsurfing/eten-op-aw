<?php

namespace App\Console\Commands;

use App\Mail\DinnerEventRegistrationClosed;
use App\Models\DinnerEvent;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DinnerEventsRegistationClosedNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dinner-events:registration-closed-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a registration list to the cook if when events are closed for registration';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // get the event that is past the registration deadline and for which the cook has not been notified
        $dinnerEvent = DinnerEvent::whereNotNull('event_verified_at')->where('registration_deadline', '<', Carbon::now())->whereNull('cook_notified_at')->first();

        if ($dinnerEvent) {
            $dinnerEvent->cook_notified_at = Carbon::now();
            $dinnerEvent->save();

            Mail::to($dinnerEvent->cook_email)->send(new DinnerEventRegistrationClosed($dinnerEvent));

            return $this->info('Dinner events have been checked for closed registrations, an email has been sent to the cook for event #'.$dinnerEvent->id);
        } else {
            return $this->info('Dinner events have been checked for closed registrations, no events were found that are past the registration deadline');
        }
    }
}
