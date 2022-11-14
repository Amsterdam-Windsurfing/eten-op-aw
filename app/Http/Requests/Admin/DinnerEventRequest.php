<?php

namespace App\Http\Requests\Admin;

use App\Models\DinnerEvent;
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

        // only for creation the date is required
        if ($this->routeIs('admin.dinner-events.store')) {
            $rules['date'][] = [
                'date',
                'required',
            ];
        }

        return $rules;
    }

    public function withValidator($validator)
    {

        $validator->after(function ($validator) {

            if ($this->routeIs('admin.dinner-events.store')) {
                $date = strtotime($validator->getData()['date']);

                // the date must be on a wednesday
                if (date("l", $date) != "Wednesday") {
                    $validator->errors()->add('date', 'The date must be on a Wednesday');
                }

                // there must NOT already be a verified dinner event on that date
                $existingEvent = DinnerEvent::where('date', date('Y-m-d', $date))->whereNotNull('event_verified_at')->first();
                if ($existingEvent) {
                    $validator->errors()->add('date', 'There is already a verified dinner event on that date');
                }
            } else {
                // the date cannot be updated so get the date from the model
                $date = strtotime($this->route()->parameters()['dinner_event']['date']);
            }

            $registrationDeadline = strtotime($validator->getData()['registration_deadline']);

            // the registration deadline must be after the saturday before the event AND before midnight of the event (in case of a late registration possibility)
            $saturdayBefore = strtotime("-1 week Saturday", $date);
            if ($registrationDeadline < $saturdayBefore) {
                $validator->errors()->add('registration_deadline', 'The registration deadline must be after the saturday before the event');
            }

            // wednesday night of the date
            $wednesdayNight = strtotime("23:59", $date);
            if ($registrationDeadline > $wednesdayNight) {
                $validator->errors()->add('registration_deadline', 'The registration deadline must be before midnight of the event');
            }

            // there must be at least one dinner option (meat, vegetarian or vegan) checked.
            $meatOption = $validator->getData()['meat_option'];
            $vegetarianOption = $validator->getData()['vegetarian_option'];
            $veganOption = $validator->getData()['vegan_option'];
            if (!$meatOption && !$vegetarianOption && !$veganOption) {
                $validator->errors()->add('dinner_options', 'At least one dinner option must be checked.');
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

        // the date may not be changed after creation
        if ($this->routeIs('dinner-events.update')) {
            $this->request->remove('date');
       }
    }


    /**
     * Convert to boolean
     *
     * @param $booleable
     * @return boolean
     */
    private function toBoolean($booleable)
    {
        return filter_var($booleable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }
}
