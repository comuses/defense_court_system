<?php

namespace Database\Factories;

use App\Models\CaseHearing;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CaseHearingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CaseHearing::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'casehearingID' => $this->faker->text(255),
            'modID' => $this->faker->text(255),
            'courtID' => $this->faker->text(255),
            'judgeID' => $this->faker->text(255),
            'attorneyID' => $this->faker->text(255),
            'attoneryWitnessID' => $this->faker->text(255),
            'accusedWitnessID' => $this->faker->text(255),
            'chilotname' => $this->faker->name(),
            'accEmpID' => $this->faker->text(255),
            'fileNumber' => $this->faker->text(255),
            'caseStartDate' => $this->faker->dateTime(),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'location' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'attorney_id' => \App\Models\Attorney::factory(),
            'court_id' => \App\Models\Court::factory(),
            'mod_id' => \App\Models\Mod::factory(),
            'judge_id' => \App\Models\Judge::factory(),
            'witness_id' => \App\Models\Witness::factory(),
        ];
    }
}
