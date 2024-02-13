<?php

namespace Database\Factories;

use App\Models\CaseCharge;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CaseChargeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CaseCharge::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'modID' => $this->faker->text(255),
            'MIDnumber' => $this->faker->text(255),
            'rank' => $this->faker->text(255),
            'fullName' => $this->faker->text(255),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'crimeType' => $this->faker->text(),
            'crimeDate' => $this->faker->dateTime(),
            'chargeDate' => $this->faker->dateTime(),
            'mod_id' => \App\Models\Mod::factory(),
            'mod_employee_id' => \App\Models\ModEmployee::factory(),
            'registrar_id' => \App\Models\Registrar::factory(),
        ];
    }
}
