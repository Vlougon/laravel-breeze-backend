<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Beneficiary;
use App\Models\MedicalData;

class MedicalDataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MedicalData::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $beneficiary = Beneficiary::inRandomOrder()->first();

        return [
            'beneficiary_id' => $beneficiary->id,
            'allergies' => $this->faker->text(),
            'illnesses' => $this->faker->text(),
            'morning_medication' => $this->faker->text(),
            'afternoon_medication' => $this->faker->text(),
            'night_medication' => $this->faker->text(),
            'preferent_morning_calls_hour' => $this->faker->time(),
            'preferent_afternoon_calls_hour' => $this->faker->time(),
            'preferent_night_calls_hour' => $this->faker->time(),
            'emergency_room_on_town' => $this->faker->randomElement(["Yes", "No"]),
            'firehouse_on_town' => $this->faker->randomElement(["Yes", "No"]),
            'police_station_on_town' => $this->faker->randomElement(["Yes", "No"]),
            'outpatient_clinic_on_town' => $this->faker->randomElement(["Yes", "No"]),
            'ambulance_on_town' => $this->faker->randomElement(["Yes", "No"]),
        ];
    }
}
