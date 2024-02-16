<?php

namespace Database\Factories;

use App\Models\Beneficiary;
use App\Models\BeneficiaryContact;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class BeneficiaryContactFactory extends Factory
{
    protected $model = BeneficiaryContact::class;

    public function definition()
    {
        $beneficiary = Beneficiary::inRandomOrder()->first();
        $contact = Contact::inRandomOrder()->first();

        return [
            'beneficiary_id' => $beneficiary->id,
            'contact_id' => $contact->id,
        ];
    }
}
