<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CaseHearing;
use App\Models\Appointment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CaseHearingAppointmentsTest extends TestCase
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
    public function it_gets_case_hearing_appointments(): void
    {
        $caseHearing = CaseHearing::factory()->create();
        $appointments = Appointment::factory()
            ->count(2)
            ->create([
                'case_hearing_id' => $caseHearing->id,
            ]);

        $response = $this->getJson(
            route('api.case-hearings.appointments.index', $caseHearing)
        );

        $response->assertOk()->assertSee($appointments[0]->caseHearID);
    }

    /**
     * @test
     */
    public function it_stores_the_case_hearing_appointments(): void
    {
        $caseHearing = CaseHearing::factory()->create();
        $data = Appointment::factory()
            ->make([
                'case_hearing_id' => $caseHearing->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.case-hearings.appointments.store', $caseHearing),
            $data
        );

        $this->assertDatabaseHas('appointments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $appointment = Appointment::latest('id')->first();

        $this->assertEquals($caseHearing->id, $appointment->case_hearing_id);
    }
}
