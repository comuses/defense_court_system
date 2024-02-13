<?php

namespace Tests\Feature\Api;

use App\Models\Mod;
use App\Models\User;
use App\Models\Appointment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModAppointmentsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_mod_appointments(): void
    {
        $mod = Mod::factory()->create();
        $appointments = Appointment::factory()
            ->count(2)
            ->create([
                'mod_id' => $mod->id,
            ]);

        $response = $this->getJson(route('api.mods.appointments.index', $mod));

        $response->assertOk()->assertSee($appointments[0]->caseHearID);
    }

    /**
     * @test
     */
    public function it_stores_the_mod_appointments(): void
    {
        $mod = Mod::factory()->create();
        $data = Appointment::factory()
            ->make([
                'mod_id' => $mod->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.mods.appointments.store', $mod),
            $data
        );

        $this->assertDatabaseHas('appointments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $appointment = Appointment::latest('id')->first();

        $this->assertEquals($mod->id, $appointment->mod_id);
    }
}
