<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Beneficiary;
use App\Models\Call;
use App\Models\User;

class CallFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Call::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $beneficiary = Beneficiary::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'beneficiary_id' => $beneficiary->id,
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'duration' => $this->faker->numberBetween(-10000, 10000),
            'call_type' => $this->faker->randomElement(["rutinary","emergency"]),
            'call_kind' => $this->faker->randomElement(["incoming","outgoing"]),
            'turn' => $this->faker->randomElement(["morning","afternoon","night"]),
            'answered_call' => $this->faker->boolean(),
            'observations' => $this->faker->text(),
            'description' => $this->faker->text(),
            'contacted_112' => $this->faker->boolean(),
        ];
    }
}
