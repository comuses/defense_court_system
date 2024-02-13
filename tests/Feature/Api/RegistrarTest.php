<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Registrar;

use App\Models\Court;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrarTest extends TestCase
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
    public function it_gets_registrars_list(): void
    {
        $registrars = Registrar::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.registrars.index'));

        $response->assertOk()->assertSee($registrars[0]->MIDNumber);
    }

    /**
     * @test
     */
    public function it_stores_the_registrar(): void
    {
        $data = Registrar::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.registrars.store'), $data);

        unset($data['courtID']);

        $this->assertDatabaseHas('registrars', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.registrars.update', $registrar),
            $data
        );

        unset($data['courtID']);

        $data['id'] = $registrar->id;

        $this->assertDatabaseHas('registrars', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_registrar(): void
    {
        $registrar = Registrar::factory()->create();

        $response = $this->deleteJson(
            route('api.registrars.destroy', $registrar)
        );

        $this->assertModelMissing($registrar);

        $response->assertNoContent();
    }
}
