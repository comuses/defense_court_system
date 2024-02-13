<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Registrar;
use App\Models\CaseCharge;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrarCaseChargesTest extends TestCase
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
    public function it_gets_registrar_case_charges(): void
    {
        $registrar = Registrar::factory()->create();
        $caseCharges = CaseCharge::factory()
            ->count(2)
            ->create([
                'registrar_id' => $registrar->id,
            ]);

        $response = $this->getJson(
            route('api.registrars.case-charges.index', $registrar)
        );

        $response->assertOk()->assertSee($caseCharges[0]->modID);
    }

    /**
     * @test
     */
    public function it_stores_the_registrar_case_charges(): void
    {
        $registrar = Registrar::factory()->create();
        $data = CaseCharge::factory()
            ->make([
                'registrar_id' => $registrar->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.registrars.case-charges.store', $registrar),
            $data
        );

        $this->assertDatabaseHas('case_charges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $caseCharge = CaseCharge::latest('id')->first();

        $this->assertEquals($registrar->id, $caseCharge->registrar_id);
    }
}
