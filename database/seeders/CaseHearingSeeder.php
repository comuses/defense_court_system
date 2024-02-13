<?php

namespace Database\Seeders;

use App\Models\CaseHearing;
use Illuminate\Database\Seeder;

class CaseHearingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CaseHearing::factory()
            ->count(5)
            ->create();
    }
}
