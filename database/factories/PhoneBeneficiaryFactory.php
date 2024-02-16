<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Beneficiary;
use App\Models\PhoneBeneficiary;

class PhoneBeneficiaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PhoneBeneficiary::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $beneficiary = Beneficiary::inRandomOrder()->first();

        return [
            'beneficiary_id' => $beneficiary->id,
            'phone_number' => $this->faker->numerify('#########'),
        ];
    }
}
