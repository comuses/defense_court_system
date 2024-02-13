<?php

namespace Database\Seeders;

use App\Models\Registrar;
use Illuminate\Database\Seeder;

class RegistrarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Registrar::factory()
            ->count(5)
            ->create();
    }
}
