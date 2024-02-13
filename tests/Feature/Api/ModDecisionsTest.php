<?php

namespace Tests\Feature\Api;

use App\Models\Mod;
use App\Models\User;
use App\Models\Decision;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModDecisionsTest extends TestCase
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
    public function it_gets_mod_decisions(): void
    {
        $mod = Mod::factory()->create();
        $decisions = Decision::factory()
            ->count(2)
            ->create([
                'mod_id' => $mod->id,
            ]);

        $response = $this->getJson(route('api.mods.decisions.index', $mod));

        $response->assertOk()->assertSee($decisions[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_mod_decisions(): void
    {
        $mod = Mod::factory()->create();
        $data = Decision::factory()
            ->make([
                'mod_id' => $mod->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.mods.decisions.store', $mod),
            $data
        );

        $this->assertDatabaseHas('decisions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $decision = Decision::latest('id')->first();

        $this->assertEquals($mod->id, $decision->mod_id);
    }
}
