<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiaryContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficiary_id',
        'contact_id',
    ];

    public function beneficiaries() {
        return $this->belongsTo(Beneficiary::class, 'beneficiary_id');
    }

    public function contacts() {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
