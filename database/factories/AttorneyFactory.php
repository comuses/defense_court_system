<?php

namespace Database\Factories;

use App\Models\Attorney;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttorneyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attorney::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'courtID' => $this->faker->text(255),
            'attoneyID' => $this->faker->text(255),
            'fullname' => $this->faker->text(255),
            'courtType' => $this->faker->text(255),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'empType' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'court_id' => \App\Models\Court::factory(),
        ];
    }
}
