<?php

namespace Database\Seeders;

use App\Models\Witness;
use Illuminate\Database\Seeder;

class WitnessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Witness::factory()
            ->count(5)
            ->create();
    }
}
