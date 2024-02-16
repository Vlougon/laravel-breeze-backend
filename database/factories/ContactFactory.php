<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => Str::limit($this->faker->name(), 35),
            'first_surname' => Str::limit($this->faker->name(), 35),
            'second_surname' => Str::limit($this->faker->name(), 35),
            'contact_type' => $this->faker->randomElement(["Familiar","Friend","Partner","Other"]),
        ];
    }
}
