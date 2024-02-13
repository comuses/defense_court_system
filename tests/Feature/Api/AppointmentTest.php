<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Appointment;

use App\Models\Mod;
use App\Models\CaseHearing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentTest extends TestCase
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
    public function it_gets_appointments_list(): void
    {
        $appointments = Appointment::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.appointments.index'));

        $response->assertOk()->assertSee($appointments[0]->caseHearID);
    }

    /**
     * @test
     */
    public function it_stores_the_appointment(): void
    {
        $data = Appointment::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.appointments.store'), $data);

        $this->assertDatabaseHas('appointments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_appointment(): void
    {
        $appointment = Appointment::factory()->create();

        $mod = Mod::factory()->create();
        $caseHearing = CaseHearing::factory()->create();

        $data = [
            'caseHearID' => $this->faker->text(255),
            'empID' => $this->faker->text(255),
            'modID' => $this->faker->text(255),
            'fullname' => $this->faker->text(255),
            'chargeType' => $this->faker->text(255),
            'appointmentDate' => $this->faker->dateTime(),
            'description' => $this->faker->sentence(15),
            'mod_id' => $mod->id,
            'case_hearing_id' => $caseHearing->id,
        ];

        $response = $this->putJson(
            route('api.appointments.update', $appointment),
            $data
        );

        $data['id'] = $appointment->id;

        $this->assertDatabaseHas('appointments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_appointment(): void
    {
        $appointment = Appointment::factory()->create();

        $response = $this->deleteJson(
            route('api.appointments.destroy', $appointment)
        );

        $this->assertModelMissing($appointment);

        $response->assertNoContent();
    }
}
