<?php

namespace Database\Factories;

use App\Models\Court;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourtFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Court::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'courtID' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'courtType' => $this->faker->word(),
            'Speciality' => $this->faker->text(255),
            'Descryption' => $this->faker->text(),
        ];
    }
}
