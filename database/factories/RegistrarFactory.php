<?php

namespace Database\Factories;

use App\Models\Registrar;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Registrar::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'MIDNumber' => $this->faker->text(255),
            'Rank' => $this->faker->text(255),
            'Name' => $this->faker->name(),
            'fieldType' => $this->faker->text(255),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'courtID' => $this->faker->text(255),
            'court_id' => \App\Models\Court::factory(),
        ];
    }
}
