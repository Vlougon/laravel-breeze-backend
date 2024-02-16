<?php

namespace Database\Seeders;

use App\Models\PhoneBeneficiary;
use Illuminate\Database\Seeder;

class PhoneBeneficiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PhoneBeneficiary::factory()->count(5)->create();
    }
}
