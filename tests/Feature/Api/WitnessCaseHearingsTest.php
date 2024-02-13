<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Witness;
use App\Models\CaseHearing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WitnessCaseHearingsTest extends TestCase
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
    public function it_gets_witness_case_hearings(): void
    {
        $witness = Witness::factory()->create();
        $caseHearings = CaseHearing::factory()
            ->count(2)
            ->create([
                'witness_id' => $witness->id,
            ]);

        $response = $this->getJson(
            route('api.witnesses.case-hearings.index', $witness)
        );

        $response->assertOk()->assertSee($caseHearings[0]->casehearingID);
    }

    /**
     * @test
     */
    public function it_stores_the_witness_case_hearings(): void
    {
        $witness = Witness::factory()->create();
        $data = CaseHearing::factory()
            ->make([
                'witness_id' => $witness->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.witnesses.case-hearings.store', $witness),
            $data
        );

        $this->assertDatabaseHas('case_hearings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $caseHearing = CaseHearing::latest('id')->first();

        $this->assertEquals($witness->id, $caseHearing->witness_id);
    }
}
