<?php

namespace Database\Seeders;

use App\Models\PhoneContact;
use Illuminate\Database\Seeder;

class PhoneContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PhoneContact::factory()->count(5)->create();
    }
}
