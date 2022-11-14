<?php

namespace App\Http\Requests;

use App\Models\DinnerEvent;
use App\Models\EventRegistration;
use App\Util\WednesdaysForDinnerEvents;
use Illuminate\Foundation\Http\FormRequest;

class EventRegistrationRequest extends FormRequest
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
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'email',
                'required',
            ],
            'dinner_option' => [
                'in:meat,vegetarian,vegan',
                'required',
            ],
            'allergies' => [
                'string'
            ],
        ];

        return $rules;
    }

    public function withValidator($validator)
    {

        $validator->after(function ($validator) {

            // event registrations are always for next wednesday
            $nextWednesdays = WednesdaysForDinnerEvents::getWednesdaysForDinnerEvents(1);
            $dinnerEvent = $nextWednesdays[0]["dinnerEvent"];

            if (!$dinnerEvent) {
                $validator->errors()->add('general', 'No dinner event found for next wednesday.');
            }

            if (EventRegistration::where('email', $validator->getData()['email'])->where('dinner_event_id', $dinnerEvent->id)->exists()) {
                $validator->errors()->add('email', 'Je ben al aangemeld voor deze woensdagavond.');
            }

            if ($dinnerEvent->registration_deadline < now()) {
                $validator->errors()->add('general', 'Aanmelden voor deze woensdagavond is niet meer mogelijk.');
            }

        });
    }
}
