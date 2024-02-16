<?php

namespace Database\Seeders;

use App\Models\PhoneUser;
use Illuminate\Database\Seeder;

class PhoneUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PhoneUser::factory()->count(5)->create();
    }
}
