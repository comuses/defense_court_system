<?php

namespace Database\Seeders;

use App\Models\Decision;
use Illuminate\Database\Seeder;

class DecisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Decision::factory()
            ->count(5)
            ->create();
    }
}
