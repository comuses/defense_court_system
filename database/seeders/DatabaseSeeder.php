<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(AppointmentSeeder::class);
        $this->call(AttorneySeeder::class);
        $this->call(BarSeeder::class);
        $this->call(CaseChargeSeeder::class);
        $this->call(CaseHearingSeeder::class);
        $this->call(CourtSeeder::class);
        $this->call(DecisionSeeder::class);
        $this->call(JudgeSeeder::class);
        $this->call(ModSeeder::class);
        $this->call(ModEmployeeSeeder::class);
        $this->call(RegistrarSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WitnessSeeder::class);
    }
}
