<?php

namespace Tests\Feature\Api;

use App\Models\Bar;
use App\Models\User;

use App\Models\Court;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BarTest extends TestCase
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
    public function it_gets_bars_list(): void
    {
        $bars = Bar::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.bars.index'));

        $response->assertOk()->assertSee($bars[0]->courtID);
    }

    /**
     * @test
     */
    public function it_stores_the_bar(): void
    {
        $data = Bar::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.bars.store'), $data);

        $this->assertDatabaseHas('bars', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_bar(): void
    {
        $bar = Bar::factory()->create();

        $court = Court::factory()->create();

        $data = [
            'courtID' => $this->faker->text(255),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'location' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'court_id' => $court->id,
        ];

        $response = $this->putJson(route('api.bars.update', $bar), $data);

        $data['id'] = $bar->id;

        $this->assertDatabaseHas('bars', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_bar(): void
    {
        $bar = Bar::factory()->create();

        $response = $this->deleteJson(route('api.bars.destroy', $bar));

        $this->assertModelMissing($bar);

        $response->assertNoContent();
    }
}
