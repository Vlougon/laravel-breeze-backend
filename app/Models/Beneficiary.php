<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Beneficiary extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_surname',
        'second_surname',
        'birth_date',
        'dni',
        'social_security_number',
        'rutine',
        'gender',
        'marital_status',
        'beneficiary_type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'birth_date' => 'date',
    ];

    public function calls(): HasMany
    {
        return $this->hasMany(Call::class);
    }

    public function reminders(): HasMany
    {
        return $this->hasMany(Reminder::class);
    }

    public function phoneBeneficiaries(): HasMany
    {
        return $this->hasMany(PhoneBeneficiary::class);
    }

    public function medicalData(): HasOne
    {
        return $this->hasOne(MedicalData::class);
    }

    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class, 'beneficiary_contacts');
    }
}
