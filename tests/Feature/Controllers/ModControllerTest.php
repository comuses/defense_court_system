<?php

namespace Tests\Feature\Controllers;

use App\Models\Mod;
use App\Models\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModControllerTest extends TestCase
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
    public function it_displays_index_view_with_mods(): void
    {
        $mods = Mod::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('mods.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.mods.index')
            ->assertViewHas('mods');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_mod(): void
    {
        $response = $this->get(route('mods.create'));

        $response->assertOk()->assertViewIs('app.mods.create');
    }

    /**
     * @test
     */
    public function it_stores_the_mod(): void
    {
        $data = Mod::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('mods.store'), $data);

        $this->assertDatabaseHas('mods', $data);

        $mod = Mod::latest('id')->first();

        $response->assertRedirect(route('mods.edit', $mod));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_mod(): void
    {
        $mod = Mod::factory()->create();

        $response = $this->get(route('mods.show', $mod));

        $response
            ->assertOk()
            ->assertViewIs('app.mods.show')
            ->assertViewHas('mod');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_mod(): void
    {
        $mod = Mod::factory()->create();

        $response = $this->get(route('mods.edit', $mod));

        $response
            ->assertOk()
            ->assertViewIs('app.mods.edit')
            ->assertViewHas('mod');
    }

    /**
     * @test
     */
    public function it_updates_the_mod(): void
    {
        $mod = Mod::factory()->create();

        $data = [
            'modID' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->put(route('mods.update', $mod), $data);

        $data['id'] = $mod->id;

        $this->assertDatabaseHas('mods', $data);

        $response->assertRedirect(route('mods.edit', $mod));
    }

    /**
     * @test
     */
    public function it_deletes_the_mod(): void
    {
        $mod = Mod::factory()->create();

        $response = $this->delete(route('mods.destroy', $mod));

        $response->assertRedirect(route('mods.index'));

        $this->assertModelMissing($mod);
    }
}
