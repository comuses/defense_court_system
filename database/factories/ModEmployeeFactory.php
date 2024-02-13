<?php

namespace Database\Factories;

use App\Models\ModEmployee;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModEmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ModEmployee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'modID' => $this->faker->text(255),
            'EmpID' => $this->faker->text(255),
            'rank' => $this->faker->text(255),
            'fullName' => $this->faker->text(255),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'empType' => $this->faker->text(255),
            'mod_id' => \App\Models\Mod::factory(),
        ];
    }
}
