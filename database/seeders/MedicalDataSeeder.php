<?php

namespace Database\Seeders;

use App\Models\MedicalData;
use Illuminate\Database\Seeder;

class MedicalDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedicalData::factory()->count(5)->create();
    }
}
