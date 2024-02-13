<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Court;
use App\Models\Attorney;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourtAttorneysTest extends TestCase
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
    public function it_gets_court_attorneys(): void
    {
        $court = Court::factory()->create();
        $attorneys = Attorney::factory()
            ->count(2)
            ->create([
                'court_id' => $court->id,
            ]);

        $response = $this->getJson(route('api.courts.attorneys.index', $court));

        $response->assertOk()->assertSee($attorneys[0]->courtID);
    }

    /**
     * @test
     */
    public function it_stores_the_court_attorneys(): void
    {
        $court = Court::factory()->create();
        $data = Attorney::factory()
            ->make([
                'court_id' => $court->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.courts.attorneys.store', $court),
            $data
        );

        $this->assertDatabaseHas('attorneys', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $attorney = Attorney::latest('id')->first();

        $this->assertEquals($court->id, $attorney->court_id);
    }
}
