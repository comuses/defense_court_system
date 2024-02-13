<?php

namespace Database\Seeders;

use App\Models\CaseCharge;
use Illuminate\Database\Seeder;

class CaseChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CaseCharge::factory()
            ->count(5)
            ->create();
    }
}
