<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Attorney;
use App\Models\CaseHearing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttorneyCaseHearingsTest extends TestCase
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
    public function it_gets_attorney_case_hearings(): void
    {
        $attorney = Attorney::factory()->create();
        $caseHearings = CaseHearing::factory()
            ->count(2)
            ->create([
                'attorney_id' => $attorney->id,
            ]);

        $response = $this->getJson(
            route('api.attorneys.case-hearings.index', $attorney)
        );

        $response->assertOk()->assertSee($caseHearings[0]->casehearingID);
    }

    /**
     * @test
     */
    public function it_stores_the_attorney_case_hearings(): void
    {
        $attorney = Attorney::factory()->create();
        $data = CaseHearing::factory()
            ->make([
                'attorney_id' => $attorney->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.attorneys.case-hearings.store', $attorney),
            $data
        );

        $this->assertDatabaseHas('case_hearings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $caseHearing = CaseHearing::latest('id')->first();

        $this->assertEquals($attorney->id, $caseHearing->attorney_id);
    }
}
