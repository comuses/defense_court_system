<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Court;
use App\Models\CaseHearing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourtCaseHearingsTest extends TestCase
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
    public function it_gets_court_case_hearings(): void
    {
        $court = Court::factory()->create();
        $caseHearings = CaseHearing::factory()
            ->count(2)
            ->create([
                'court_id' => $court->id,
            ]);

        $response = $this->getJson(
            route('api.courts.case-hearings.index', $court)
        );

        $response->assertOk()->assertSee($caseHearings[0]->casehearingID);
    }

    /**
     * @test
     */
    public function it_stores_the_court_case_hearings(): void
    {
        $court = Court::factory()->create();
        $data = CaseHearing::factory()
            ->make([
                'court_id' => $court->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.courts.case-hearings.store', $court),
            $data
        );

        $this->assertDatabaseHas('case_hearings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $caseHearing = CaseHearing::latest('id')->first();

        $this->assertEquals($court->id, $caseHearing->court_id);
    }
}
