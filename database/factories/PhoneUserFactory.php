<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PhoneUser;
use App\Models\User;

class PhoneUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PhoneUser::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'phone_number' => $this->faker->numerify('#########'),
        ];
    }
}
