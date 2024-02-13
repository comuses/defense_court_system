<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'caseHearID' => $this->faker->text(255),
            'empID' => $this->faker->text(255),
            'modID' => $this->faker->text(255),
            'fullname' => $this->faker->text(255),
            'chargeType' => $this->faker->text(255),
            'appointmentDate' => $this->faker->dateTime(),
            'description' => $this->faker->sentence(15),
            'mod_id' => \App\Models\Mod::factory(),
            'case_hearing_id' => \App\Models\CaseHearing::factory(),
        ];
    }
}
