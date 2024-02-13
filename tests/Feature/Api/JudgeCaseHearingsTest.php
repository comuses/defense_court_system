<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Judge;
use App\Models\CaseHearing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JudgeCaseHearingsTest extends TestCase
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
    public function it_gets_judge_case_hearings(): void
    {
        $judge = Judge::factory()->create();
        $caseHearings = CaseHearing::factory()
            ->count(2)
            ->create([
                'judge_id' => $judge->id,
            ]);

        $response = $this->getJson(
            route('api.judges.case-hearings.index', $judge)
        );

        $response->assertOk()->assertSee($caseHearings[0]->casehearingID);
    }

    /**
     * @test
     */
    public function it_stores_the_judge_case_hearings(): void
    {
        $judge = Judge::factory()->create();
        $data = CaseHearing::factory()
            ->make([
                'judge_id' => $judge->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.judges.case-hearings.store', $judge),
            $data
        );

        $this->assertDatabaseHas('case_hearings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $caseHearing = CaseHearing::latest('id')->first();

        $this->assertEquals($judge->id, $caseHearing->judge_id);
    }
}
