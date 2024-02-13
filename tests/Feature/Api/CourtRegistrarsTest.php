<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Court;
use App\Models\Registrar;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourtRegistrarsTest extends TestCase
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
    public function it_gets_court_registrars(): void
    {
        $court = Court::factory()->create();
        $registrars = Registrar::factory()
            ->count(2)
            ->create([
                'court_id' => $court->id,
            ]);

        $response = $this->getJson(
            route('api.courts.registrars.index', $court)
        );

        $response->assertOk()->assertSee($registrars[0]->MIDNumber);
    }

    /**
     * @test
     */
    public function it_stores_the_court_registrars(): void
    {
        $court = Court::factory()->create();
        $data = Registrar::factory()
            ->make([
                'court_id' => $court->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.courts.registrars.store', $court),
            $data
        );

        unset($data['courtID']);

        $this->assertDatabaseHas('registrars', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $registrar = Registrar::latest('id')->first();

        $this->assertEquals($court->id, $registrar->court_id);
    }
}
