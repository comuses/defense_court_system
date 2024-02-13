<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Witness;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WitnessControllerTest extends TestCase
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
    public function it_displays_index_view_with_witnesses(): void
    {
        $witnesses = Witness::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('witnesses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.witnesses.index')
            ->assertViewHas('witnesses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_witness(): void
    {
        $response = $this->get(route('witnesses.create'));

        $response->assertOk()->assertViewIs('app.witnesses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_witness(): void
    {
        $data = Witness::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('witnesses.store'), $data);

        $this->assertDatabaseHas('witnesses', $data);

        $witness = Witness::latest('id')->first();

        $response->assertRedirect(route('witnesses.edit', $witness));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_witness(): void
    {
        $witness = Witness::factory()->create();

        $response = $this->get(route('witnesses.show', $witness));

        $response
            ->assertOk()
            ->assertViewIs('app.witnesses.show')
            ->assertViewHas('witness');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_witness(): void
    {
        $witness = Witness::factory()->create();

        $response = $this->get(route('witnesses.edit', $witness));

        $response
            ->assertOk()
            ->assertViewIs('app.witnesses.edit')
            ->assertViewHas('witness');
    }

    /**
     * @test
     */
    public function it_updates_the_witness(): void
    {
        $witness = Witness::factory()->create();

        $data = [
            'witnessID' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'attorneyWitness' => $this->faker->text(255),
            'Description' => $this->faker->sentence(15),
            'accusedWitness' => $this->faker->text(255),
            'attoneyID' => $this->faker->text(255),
            'caseChargedID' => $this->faker->text(255),
        ];

        $response = $this->put(route('witnesses.update', $witness), $data);

        $data['id'] = $witness->id;

        $this->assertDatabaseHas('witnesses', $data);

        $response->assertRedirect(route('witnesses.edit', $witness));
    }

    /**
     * @test
     */
    public function it_deletes_the_witness(): void
    {
        $witness = Witness::factory()->create();

        $response = $this->delete(route('witnesses.destroy', $witness));

        $response->assertRedirect(route('witnesses.index'));

        $this->assertModelMissing($witness);
    }
}
