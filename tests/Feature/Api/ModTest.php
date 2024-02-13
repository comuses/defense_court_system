<?php

namespace Tests\Feature\Api;

use App\Models\Mod;
use App\Models\User;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModTest extends TestCase
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
    public function it_gets_mods_list(): void
    {
        $mods = Mod::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.mods.index'));

        $response->assertOk()->assertSee($mods[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_mod(): void
    {
        $data = Mod::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.mods.store'), $data);

        $this->assertDatabaseHas('mods', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.mods.update', $mod), $data);

        $data['id'] = $mod->id;

        $this->assertDatabaseHas('mods', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_mod(): void
    {
        $mod = Mod::factory()->create();

        $response = $this->deleteJson(route('api.mods.destroy', $mod));

        $this->assertModelMissing($mod);

        $response->assertNoContent();
    }
}
