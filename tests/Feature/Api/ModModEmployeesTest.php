<?php

namespace Tests\Feature\Api;

use App\Models\Mod;
use App\Models\User;
use App\Models\ModEmployee;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModModEmployeesTest extends TestCase
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
    public function it_gets_mod_mod_employees(): void
    {
        $mod = Mod::factory()->create();
        $modEmployees = ModEmployee::factory()
            ->count(2)
            ->create([
                'mod_id' => $mod->id,
            ]);

        $response = $this->getJson(route('api.mods.mod-employees.index', $mod));

        $response->assertOk()->assertSee($modEmployees[0]->modID);
    }

    /**
     * @test
     */
    public function it_stores_the_mod_mod_employees(): void
    {
        $mod = Mod::factory()->create();
        $data = ModEmployee::factory()
            ->make([
                'mod_id' => $mod->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.mods.mod-employees.store', $mod),
            $data
        );

        $this->assertDatabaseHas('mod_employees', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $modEmployee = ModEmployee::latest('id')->first();

        $this->assertEquals($mod->id, $modEmployee->mod_id);
    }
}
