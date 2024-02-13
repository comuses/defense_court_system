<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Attorney;

use App\Models\Court;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttorneyControllerTest extends TestCase
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
    public function it_displays_index_view_with_attorneys(): void
    {
        $attorneys = Attorney::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('attorneys.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.attorneys.index')
            ->assertViewHas('attorneys');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_attorney(): void
    {
        $response = $this->get(route('attorneys.create'));

        $response->assertOk()->assertViewIs('app.attorneys.create');
    }

    /**
     * @test
     */
    public function it_stores_the_attorney(): void
    {
        $data = Attorney::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('attorneys.store'), $data);

        $this->assertDatabaseHas('attorneys', $data);

        $attorney = Attorney::latest('id')->first();

        $response->assertRedirect(route('attorneys.edit', $attorney));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_attorney(): void
    {
        $attorney = Attorney::factory()->create();

        $response = $this->get(route('attorneys.show', $attorney));

        $response
            ->assertOk()
            ->assertViewIs('app.attorneys.show')
            ->assertViewHas('attorney');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_attorney(): void
    {
        $attorney = Attorney::factory()->create();

        $response = $this->get(route('attorneys.edit', $attorney));

        $response
            ->assertOk()
            ->assertViewIs('app.attorneys.edit')
            ->assertViewHas('attorney');
    }

    /**
     * @test
     */
    public function it_updates_the_attorney(): void
    {
        $attorney = Attorney::factory()->create();

        $court = Court::factory()->create();

        $data = [
            'courtID' => $this->faker->text(255),
            'attoneyID' => $this->faker->text(255),
            'fullname' => $this->faker->text(255),
            'courtType' => $this->faker->text(255),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'empType' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'court_id' => $court->id,
        ];

        $response = $this->put(route('attorneys.update', $attorney), $data);

        $data['id'] = $attorney->id;

        $this->assertDatabaseHas('attorneys', $data);

        $response->assertRedirect(route('attorneys.edit', $attorney));
    }

    /**
     * @test
     */
    public function it_deletes_the_attorney(): void
    {
        $attorney = Attorney::factory()->create();

        $response = $this->delete(route('attorneys.destroy', $attorney));

        $response->assertRedirect(route('attorneys.index'));

        $this->assertModelMissing($attorney);
    }
}
