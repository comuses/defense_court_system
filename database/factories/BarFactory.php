<?php

namespace Database\Factories;

use App\Models\Bar;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bar::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'courtID' => $this->faker->text(255),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'location' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'court_id' => \App\Models\Court::factory(),
        ];
    }
}
