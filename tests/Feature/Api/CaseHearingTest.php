<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CaseHearing;

use App\Models\Mod;
use App\Models\Court;
use App\Models\Judge;
use App\Models\Witness;
use App\Models\Attorney;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CaseHearingTest extends TestCase
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
    public function it_gets_case_hearings_list(): void
    {
        $caseHearings = CaseHearing::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.case-hearings.index'));

        $response->assertOk()->assertSee($caseHearings[0]->casehearingID);
    }

    /**
     * @test
     */
    public function it_stores_the_case_hearing(): void
    {
        $data = CaseHearing::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.case-hearings.store'), $data);

        $this->assertDatabaseHas('case_hearings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_case_hearing(): void
    {
        $caseHearing = CaseHearing::factory()->create();

        $attorney = Attorney::factory()->create();
        $court = Court::factory()->create();
        $mod = Mod::factory()->create();
        $judge = Judge::factory()->create();
        $witness = Witness::factory()->create();

        $data = [
            'casehearingID' => $this->faker->text(255),
            'modID' => $this->faker->text(255),
            'courtID' => $this->faker->text(255),
            'judgeID' => $this->faker->text(255),
            'attorneyID' => $this->faker->text(255),
            'attoneryWitnessID' => $this->faker->text(255),
            'accusedWitnessID' => $this->faker->text(255),
            'chilotname' => $this->faker->name(),
            'accEmpID' => $this->faker->text(255),
            'fileNumber' => $this->faker->text(255),
            'caseStartDate' => $this->faker->dateTime(),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'location' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'attorney_id' => $attorney->id,
            'court_id' => $court->id,
            'mod_id' => $mod->id,
            'judge_id' => $judge->id,
            'witness_id' => $witness->id,
        ];

        $response = $this->putJson(
            route('api.case-hearings.update', $caseHearing),
            $data
        );

        $data['id'] = $caseHearing->id;

        $this->assertDatabaseHas('case_hearings', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_case_hearing(): void
    {
        $caseHearing = CaseHearing::factory()->create();

        $response = $this->deleteJson(
            route('api.case-hearings.destroy', $caseHearing)
        );

        $this->assertModelMissing($caseHearing);

        $response->assertNoContent();
    }
}
