<?php

namespace Tests\Feature\Api;

use App\Models\Mod;
use App\Models\User;
use App\Models\CaseCharge;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModCaseChargesTest extends TestCase
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
    public function it_gets_mod_case_charges(): void
    {
        $mod = Mod::factory()->create();
        $caseCharges = CaseCharge::factory()
            ->count(2)
            ->create([
                'mod_id' => $mod->id,
            ]);

        $response = $this->getJson(route('api.mods.case-charges.index', $mod));

        $response->assertOk()->assertSee($caseCharges[0]->modID);
    }

    /**
     * @test
     */
    public function it_stores_the_mod_case_charges(): void
    {
        $mod = Mod::factory()->create();
        $data = CaseCharge::factory()
            ->make([
                'mod_id' => $mod->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.mods.case-charges.store', $mod),
            $data
        );

        $this->assertDatabaseHas('case_charges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $caseCharge = CaseCharge::latest('id')->first();

        $this->assertEquals($mod->id, $caseCharge->mod_id);
    }
}
