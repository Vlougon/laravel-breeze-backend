<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\PhoneContact;

class PhoneContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PhoneContact::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $contact = Contact::inRandomOrder()->first();

        return [
            'contact_id' => $contact->id,
            'phone_number' => $this->faker->numerify('#########'),
        ];
    }
}
