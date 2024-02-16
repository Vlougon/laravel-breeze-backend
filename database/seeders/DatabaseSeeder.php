<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Beneficiary;
use App\Models\BeneficiaryContact;
use App\Models\Call;
use App\Models\Contact;
use App\Models\MedicalData;
use App\Models\PhoneBeneficiary;
use App\Models\PhoneContact;
use App\Models\PhoneUser;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Beneficiary::factory()->count(5)->create();
        User::factory()->count(5)->create();
        Call::factory()->count(5)->create();
        Contact::factory()->count(5)->create();
        BeneficiaryContact::factory()->count(5)->create();
        MedicalData::factory()->count(5)->create();
        Reminder::factory()->count(5)->create();
        PhoneUser::factory()->count(5)->create();
        PhoneBeneficiary::factory()->count(5)->create();
        PhoneContact::factory()->count(5)->create();
    }
}
