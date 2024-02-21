<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function calls(): HasMany
    {
        return $this->hasMany(Call::class);
    }

    public function reminders(): HasMany
    {
        return $this->hasMany(Reminder::class);
    }

    public function phoneUsers(): HasMany
    {
        return $this->hasMany(PhoneUser::class);
    }

    /*    --      ** Relaciones HasManyThrough **     --     */

    public function medicalData(): HasManyThrough
    {
        return $this->hasOneThrough(MedicalData::class, Call::class, 'user_id', 'id');
    }

    public function beneficiaryContacts(): HasManyThrough
    {
        return $this->hasManyThrough(Contact::class, Call::class, 'user_id', 'id');
    }
}
