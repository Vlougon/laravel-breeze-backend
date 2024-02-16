<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalData extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'beneficiary_id',
        'allergies',
        'illnesses',
        'morning_medication',
        'afternoon_medication',
        'night_medication',
        'preferent_morning_calls_hour',
        'preferent_afternoon_calls_hour',
        'preferent_night_calls_hour',
        'emergency_room_on_town',
        'firehouse_on_town',
        'police_station_on_town',
        'outpatient_clinic_on_town',
        'ambulance_on_town',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'beneficiary_id' => 'integer',
    ];

    public function beneficiary(): BelongsTo
    {
        return $this->belongsTo(Beneficiary::class);
    }
}
