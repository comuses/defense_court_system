<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\CaseHearing;

use App\Models\Mod;
use App\Models\Court;
use App\Models\Judge;
use App\Models\Witness;
use App\Models\Attorney;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CaseHearingControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_case_hearings(): void
    {
        $caseHearings = CaseHearing::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('case-hearings.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.case_hearings.index')
            ->assertViewHas('caseHearings');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_case_hearing(): void
    {
        $response = $this->get(route('case-hearings.create'));

        $response->assertOk()->assertViewIs('app.case_hearings.create');
    }

    /**
     * @test
     */
    public function it_stores_the_case_hearing(): void
    {
        $data = CaseHearing::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('case-hearings.store'), $data);

        $this->assertDatabaseHas('case_hearings', $data);

        $caseHearing = CaseHearing::latest('id')->first();

        $response->assertRedirect(route('case-hearings.edit', $caseHearing));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_case_hearing(): void
    {
        $caseHearing = CaseHearing::factory()->create();

        $response = $this->get(route('case-hearings.show', $caseHearing));

        $response
            ->assertOk()
            ->assertViewIs('app.case_hearings.show')
            ->assertViewHas('caseHearing');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_case_hearing(): void
    {
        $caseHearing = CaseHearing::factory()->create();

        $response = $this->get(route('case-hearings.edit', $caseHearing));

        $response
            ->assertOk()
            ->assertViewIs('app.case_hearings.edit')
            ->assertViewHas('caseHearing');
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

        $response = $this->put(
            route('case-hearings.update', $caseHearing),
            $data
        );

        $data['id'] = $caseHearing->id;

        $this->assertDatabaseHas('case_hearings', $data);

        $response->assertRedirect(route('case-hearings.edit', $caseHearing));
    }

    /**
     * @test
     */
    public function it_deletes_the_case_hearing(): void
    {
        $caseHearing = CaseHearing::factory()->create();

        $response = $this->delete(route('case-hearings.destroy', $caseHearing));

        $response->assertRedirect(route('case-hearings.index'));

        $this->assertModelMissing($caseHearing);
    }
}
