<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Decision;
use App\Models\CaseHearing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CaseHearingDecisionsTest extends TestCase
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
    public function it_gets_case_hearing_decisions(): void
    {
        $caseHearing = CaseHearing::factory()->create();
        $decisions = Decision::factory()
            ->count(2)
            ->create([
                'case_hearing_id' => $caseHearing->id,
            ]);

        $response = $this->getJson(
            route('api.case-hearings.decisions.index', $caseHearing)
        );

        $response->assertOk()->assertSee($decisions[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_case_hearing_decisions(): void
    {
        $caseHearing = CaseHearing::factory()->create();
        $data = Decision::factory()
            ->make([
                'case_hearing_id' => $caseHearing->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.case-hearings.decisions.store', $caseHearing),
            $data
        );

        $this->assertDatabaseHas('decisions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $decision = Decision::latest('id')->first();

        $this->assertEquals($caseHearing->id, $decision->case_hearing_id);
    }
}
