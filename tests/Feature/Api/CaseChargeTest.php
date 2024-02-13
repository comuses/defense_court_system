<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CaseCharge;

use App\Models\Mod;
use App\Models\Registrar;
use App\Models\ModEmployee;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CaseChargeTest extends TestCase
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
    public function it_gets_case_charges_list(): void
    {
        $caseCharges = CaseCharge::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.case-charges.index'));

        $response->assertOk()->assertSee($caseCharges[0]->modID);
    }

    /**
     * @test
     */
    public function it_stores_the_case_charge(): void
    {
        $data = CaseCharge::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.case-charges.store'), $data);

        $this->assertDatabaseHas('case_charges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_case_charge(): void
    {
        $caseCharge = CaseCharge::factory()->create();

        $mod = Mod::factory()->create();
        $modEmployee = ModEmployee::factory()->create();
        $registrar = Registrar::factory()->create();

        $data = [
            'modID' => $this->faker->text(255),
            'MIDnumber' => $this->faker->text(255),
            'rank' => $this->faker->text(255),
            'fullName' => $this->faker->text(255),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'crimeType' => $this->faker->text(),
            'crimeDate' => $this->faker->dateTime(),
            'chargeDate' => $this->faker->dateTime(),
            'mod_id' => $mod->id,
            'mod_employee_id' => $modEmployee->id,
            'registrar_id' => $registrar->id,
        ];

        $response = $this->putJson(
            route('api.case-charges.update', $caseCharge),
            $data
        );

        $data['id'] = $caseCharge->id;

        $this->assertDatabaseHas('case_charges', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_case_charge(): void
    {
        $caseCharge = CaseCharge::factory()->create();

        $response = $this->deleteJson(
            route('api.case-charges.destroy', $caseCharge)
        );

        $this->assertModelMissing($caseCharge);

        $response->assertNoContent();
    }
}
