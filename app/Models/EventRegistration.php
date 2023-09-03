<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'allergies',
        'dinner_option',
        'dinner_event_id',
        'registration_verified_at',
        'plus_one',
        'after_training',
    ];

    public function dinnerEvent()
    {
        return $this->belongsTo(DinnerEvent::class);
    }
}
