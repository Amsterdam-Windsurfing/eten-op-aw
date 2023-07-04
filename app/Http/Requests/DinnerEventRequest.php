<?php

namespace App\Http\Requests;

use App\Models\DinnerEvent;
use App\Util\WednesdaysForDinnerEvents;
use Illuminate\Foundation\Http\FormRequest;

class DinnerEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'cook_name' => [
                'string',
                'required',
            ],
            'cook_email' => [
                'email',
                'required',
            ],
            'description' => [
                'string',
                'required',
            ],
            'registration_deadline' => [
                'date',
                'required',
            ],
            'meat_option' => [
                'boolean',
                'required',
            ],
            'vegetarian_option' => [
                'boolean',
                'required',
            ],
            'vegan_option' => [
                'boolean',
                'required',
            ],
        ];

        return $rules;
    }

    public function withValidator($validator)
    {

        $validator->after(function ($validator) {

            // public creation of events are always for next wednesday
            $nextWednesdays = WednesdaysForDinnerEvents::getWednesdaysForDinnerEvents(1);
            $date = $nextWednesdays[0]['date']->getTimestamp();

            // there must NOT already be a verified dinner event on that date
            $existingEvent = DinnerEvent::where('date', date('Y-m-d', $date))->whereNotNull('event_verified_at')->first();
            if ($existingEvent) {
                $validator->errors()->add('general', 'Er gaat al iemand koken op deze datum.');
            }

            $registrationDeadline = strtotime($validator->getData()['registration_deadline']);

            // the registration deadline must be after the saturday before the event AND before midnight of the event (in case of a late registration possibility)
            $saturdayBefore = strtotime('-1 week Saturday', $date);
            if ($registrationDeadline < $saturdayBefore) {
                $validator->errors()->add('registration_deadline', 'Dit is een ongeldige datum voor deze woensdag.');
            }

            // wednesday night of the date
            $wednesdayNight = strtotime('23:59', $date);
            if ($registrationDeadline > $wednesdayNight) {
                $validator->errors()->add('registration_deadline', 'Dit is een ongeldige datum voor deze woensdag.');
            }

            // there must be at least one dinner option (meat, vegetarian or vegan) checked.
            $meatOption = $validator->getData()['meat_option'];
            $vegetarianOption = $validator->getData()['vegetarian_option'];
            $veganOption = $validator->getData()['vegan_option'];
            if (! $meatOption && ! $vegetarianOption && ! $veganOption) {
                $validator->errors()->add('dinner_options', 'Je moet aangeven of je vlees, vegetarisch en/of vegan gaat koken.');
            }
        });
    }

    /**
     * Prepare inputs for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'meat_option' => $this->toBoolean($this->meat_option),
            'vegetarian_option' => $this->toBoolean($this->vegetarian_option),
            'vegan_option' => $this->toBoolean($this->vegan_option),
        ]);
    }

    /**
     * Convert to boolean
     *
     * @return bool
     */
    private function toBoolean($booleable)
    {
        return filter_var($booleable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }
}
