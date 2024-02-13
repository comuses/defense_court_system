<?php

namespace Database\Factories;

use App\Models\Witness;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WitnessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Witness::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'witnessID' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'attorneyWitness' => $this->faker->text(255),
            'Description' => $this->faker->sentence(15),
            'accusedWitness' => $this->faker->text(255),
            'attoneyID' => $this->faker->text(255),
            'caseChargedID' => $this->faker->text(255),
        ];
    }
}
