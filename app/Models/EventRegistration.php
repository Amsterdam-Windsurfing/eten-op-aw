<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'registration_verified_at'
    ];

    public function dinnerEvent()
    {
        return $this->belongsTo(DinnerEvent::class);
    }
}
