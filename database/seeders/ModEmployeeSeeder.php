<?php

namespace Database\Seeders;

use App\Models\ModEmployee;
use Illuminate\Database\Seeder;

class ModEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModEmployee::factory()
            ->count(5)
            ->create();
    }
}
