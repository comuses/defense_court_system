<?php

namespace Database\Factories;

use App\Models\Judge;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JudgeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Judge::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'CourtID' => $this->faker->text(255),
            'judgeID' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'courtType' => $this->faker->text(255),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'empType' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'court_id' => \App\Models\Court::factory(),
        ];
    }
}
