<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DinnerEvent extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'date',
        'cook_name',
        'cook_email',
        'description',
        'meat_option',
        'vegetarian_option',
        'vegan_option',
        'registration_deadline',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
        'registration_deadline' => 'datetime',
    ];

    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function eventRegistrationsOptions()
    {
        // calculate the number of registrations for each option
        $meat = $this->eventRegistrations()->where('dinner_option', 'meat')->whereNotNull('registration_verified_at')->count();
        $vegetarian = $this->eventRegistrations()->where('dinner_option', 'vegetarian')->whereNotNull('registration_verified_at')->count();
        $vegan = $this->eventRegistrations()->where('dinner_option', 'vegan')->whereNotNull('registration_verified_at')->count();

        return [
            'meat' => $meat,
            'vegetarian' => $vegetarian,
            'vegan' => $vegan,
        ];
    }
}
