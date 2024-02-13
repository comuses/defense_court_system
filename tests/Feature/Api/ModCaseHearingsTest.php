<?php

namespace Tests\Feature\Api;

use App\Models\Mod;
use App\Models\User;
use App\Models\CaseHearing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModCaseHearingsTest extends TestCase
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
    public function it_gets_mod_case_hearings(): void
    {
        $mod = Mod::factory()->create();
        $caseHearings = CaseHearing::factory()
            ->count(2)
            ->create([
                'mod_id' => $mod->id,
            ]);

        $response = $this->getJson(route('api.mods.case-hearings.index', $mod));

        $response->assertOk()->assertSee($caseHearings[0]->casehearingID);
    }

    /**
     * @test
     */
    public function it_stores_the_mod_case_hearings(): void
    {
        $mod = Mod::factory()->create();
        $data = CaseHearing::factory()
            ->make([
                'mod_id' => $mod->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.mods.case-hearings.store', $mod),
            $data
        );

        $this->assertDatabaseHas('case_hearings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $caseHearing = CaseHearing::latest('id')->first();

        $this->assertEquals($mod->id, $caseHearing->mod_id);
    }
}
