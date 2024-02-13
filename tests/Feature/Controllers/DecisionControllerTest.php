<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Decision;

use App\Models\Mod;
use App\Models\CaseHearing;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DecisionControllerTest extends TestCase
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
    public function it_displays_index_view_with_decisions(): void
    {
        $decisions = Decision::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('decisions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.decisions.index')
            ->assertViewHas('decisions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_decision(): void
    {
        $response = $this->get(route('decisions.create'));

        $response->assertOk()->assertViewIs('app.decisions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_decision(): void
    {
        $data = Decision::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('decisions.store'), $data);

        $this->assertDatabaseHas('decisions', $data);

        $decision = Decision::latest('id')->first();

        $response->assertRedirect(route('decisions.edit', $decision));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_decision(): void
    {
        $decision = Decision::factory()->create();

        $response = $this->get(route('decisions.show', $decision));

        $response
            ->assertOk()
            ->assertViewIs('app.decisions.show')
            ->assertViewHas('decision');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_decision(): void
    {
        $decision = Decision::factory()->create();

        $response = $this->get(route('decisions.edit', $decision));

        $response
            ->assertOk()
            ->assertViewIs('app.decisions.edit')
            ->assertViewHas('decision');
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

        $response = $this->put(route('decisions.update', $decision), $data);

        $data['id'] = $decision->id;

        $this->assertDatabaseHas('decisions', $data);

        $response->assertRedirect(route('decisions.edit', $decision));
    }

    /**
     * @test
     */
    public function it_deletes_the_decision(): void
    {
        $decision = Decision::factory()->create();

        $response = $this->delete(route('decisions.destroy', $decision));

        $response->assertRedirect(route('decisions.index'));

        $this->assertModelMissing($decision);
    }
}
