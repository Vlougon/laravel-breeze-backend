<?php

namespace Database\Seeders;

use App\Models\BeneficiaryContact;
use Illuminate\Database\Seeder;

class BeneficiaryContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BeneficiaryContact::factory()->count(5)->create();
    }
}
