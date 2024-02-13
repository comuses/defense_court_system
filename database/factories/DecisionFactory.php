<?php

namespace Database\Factories;

use App\Models\Decision;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DecisionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Decision::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'caseHearingID' => $this->faker->text(255),
            'modID' => $this->faker->text(255),
            'empID' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'chargeType' => $this->faker->text(255),
            'caseStartDate' => $this->faker->dateTime(),
            'decisionDate' => $this->faker->dateTime(),
            'decisionType' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'mod_id' => \App\Models\Mod::factory(),
            'case_hearing_id' => \App\Models\CaseHearing::factory(),
        ];
    }
}
