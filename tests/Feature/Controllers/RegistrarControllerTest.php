<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Registrar;

use App\Models\Court;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrarControllerTest extends TestCase
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
    public function it_displays_index_view_with_registrars(): void
    {
        $registrars = Registrar::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('registrars.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.registrars.index')
            ->assertViewHas('registrars');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_registrar(): void
    {
        $response = $this->get(route('registrars.create'));

        $response->assertOk()->assertViewIs('app.registrars.create');
    }

    /**
     * @test
     */
    public function it_stores_the_registrar(): void
    {
        $data = Registrar::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('registrars.store'), $data);

        unset($data['courtID']);

        $this->assertDatabaseHas('registrars', $data);

        $registrar = Registrar::latest('id')->first();

        $response->assertRedirect(route('registrars.edit', $registrar));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_registrar(): void
    {
        $registrar = Registrar::factory()->create();

        $response = $this->get(route('registrars.show', $registrar));

        $response
            ->assertOk()
            ->assertViewIs('app.registrars.show')
            ->assertViewHas('registrar');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_registrar(): void
    {
        $registrar = Registrar::factory()->create();

        $response = $this->get(route('registrars.edit', $registrar));

        $response
            ->assertOk()
            ->assertViewIs('app.registrars.edit')
            ->assertViewHas('registrar');
    }

    /**
     * @test
     */
    public function it_updates_the_registrar(): void
    {
        $registrar = Registrar::factory()->create();

        $court = Court::factory()->create();

        $data = [
            'MIDNumber' => $this->faker->text(255),
            'Rank' => $this->faker->text(255),
            'Name' => $this->faker->name(),
            'fieldType' => $this->faker->text(255),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'courtID' => $this->faker->text(255),
            'court_id' => $court->id,
        ];

        $response = $this->put(route('registrars.update', $registrar), $data);

        unset($data['courtID']);

        $data['id'] = $registrar->id;

        $this->assertDatabaseHas('registrars', $data);

        $response->assertRedirect(route('registrars.edit', $registrar));
    }

    /**
     * @test
     */
    public function it_deletes_the_registrar(): void
    {
        $registrar = Registrar::factory()->create();

        $response = $this->delete(route('registrars.destroy', $registrar));

        $response->assertRedirect(route('registrars.index'));

        $this->assertModelMissing($registrar);
    }
}
