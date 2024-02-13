<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Decision;

use App\Models\Mod;
use App\Models\CaseHearing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DecisionTest extends TestCase
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
    public function it_gets_decisions_list(): void
    {
        $decisions = Decision::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.decisions.index'));

        $response->assertOk()->assertSee($decisions[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_decision(): void
    {
        $data = Decision::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.decisions.store'), $data);

        $this->assertDatabaseHas('decisions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_decision(): void
    {
        $decision = Decision::factory()->create();

        $mod = Mod::factory()->create();
        $caseHearing = CaseHearing::factory()->create();

        $data = [
            'caseHearingID' => $this->faker->text(255),
            'modID' => $this->faker->text(255),
            'empID' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'chargeType' => $this->faker->text(255),
            'caseStartDate' => $this->faker->dateTime(),
            'decisionDate' => $this->faker->dateTime(),
            'decisionType' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'mod_id' => $mod->id,
            'case_hearing_id' => $caseHearing->id,
        ];

        $response = $this->putJson(
            route('api.decisions.update', $decision),
            $data
        );

        $data['id'] = $decision->id;

        $this->assertDatabaseHas('decisions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_decision(): void
    {
        $decision = Decision::factory()->create();

        $response = $this->deleteJson(
            route('api.decisions.destroy', $decision)
        );

        $this->assertModelMissing($decision);

        $response->assertNoContent();
    }
}
