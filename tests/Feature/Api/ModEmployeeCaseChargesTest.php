<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CaseCharge;
use App\Models\ModEmployee;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModEmployeeCaseChargesTest extends TestCase
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
    public function it_gets_mod_employee_case_charges(): void
    {
        $modEmployee = ModEmployee::factory()->create();
        $caseCharges = CaseCharge::factory()
            ->count(2)
            ->create([
                'mod_employee_id' => $modEmployee->id,
            ]);

        $response = $this->getJson(
            route('api.mod-employees.case-charges.index', $modEmployee)
        );

        $response->assertOk()->assertSee($caseCharges[0]->modID);
    }

    /**
     * @test
     */
    public function it_stores_the_mod_employee_case_charges(): void
    {
        $modEmployee = ModEmployee::factory()->create();
        $data = CaseCharge::factory()
            ->make([
                'mod_employee_id' => $modEmployee->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.mod-employees.case-charges.store', $modEmployee),
            $data
        );

        $this->assertDatabaseHas('case_charges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $caseCharge = CaseCharge::latest('id')->first();

        $this->assertEquals($modEmployee->id, $caseCharge->mod_employee_id);
    }
}
