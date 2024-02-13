<?php

namespace Tests\Feature\Api;

use App\Models\Bar;
use App\Models\User;
use App\Models\Court;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourtBarsTest extends TestCase
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
    public function it_gets_court_bars(): void
    {
        $court = Court::factory()->create();
        $bars = Bar::factory()
            ->count(2)
            ->create([
                'court_id' => $court->id,
            ]);

        $response = $this->getJson(route('api.courts.bars.index', $court));

        $response->assertOk()->assertSee($bars[0]->courtID);
    }

    /**
     * @test
     */
    public function it_stores_the_court_bars(): void
    {
        $court = Court::factory()->create();
        $data = Bar::factory()
            ->make([
                'court_id' => $court->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.courts.bars.store', $court),
            $data
        );

        $this->assertDatabaseHas('bars', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $bar = Bar::latest('id')->first();

        $this->assertEquals($court->id, $bar->court_id);
    }
}
