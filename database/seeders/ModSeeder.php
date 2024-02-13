<?php

namespace Database\Seeders;

use App\Models\Mod;
use Illuminate\Database\Seeder;

class ModSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mod::factory()
            ->count(5)
            ->create();
    }
}
