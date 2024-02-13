<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ModEmployee;

use App\Models\Mod;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModEmployeeTest extends TestCase
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
    public function it_gets_mod_employees_list(): void
    {
        $modEmployees = ModEmployee::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.mod-employees.index'));

        $response->assertOk()->assertSee($modEmployees[0]->modID);
    }

    /**
     * @test
     */
    public function it_stores_the_mod_employee(): void
    {
        $data = ModEmployee::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.mod-employees.store'), $data);

        $this->assertDatabaseHas('mod_employees', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_mod_employee(): void
    {
        $modEmployee = ModEmployee::factory()->create();

        $mod = Mod::factory()->create();

        $data = [
            'modID' => $this->faker->text(255),
            'EmpID' => $this->faker->text(255),
            'rank' => $this->faker->text(255),
            'fullName' => $this->faker->text(255),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'empType' => $this->faker->text(255),
            'mod_id' => $mod->id,
        ];

        $response = $this->putJson(
            route('api.mod-employees.update', $modEmployee),
            $data
        );

        $data['id'] = $modEmployee->id;

        $this->assertDatabaseHas('mod_employees', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_mod_employee(): void
    {
        $modEmployee = ModEmployee::factory()->create();

        $response = $this->deleteJson(
            route('api.mod-employees.destroy', $modEmployee)
        );

        $this->assertModelMissing($modEmployee);

        $response->assertNoContent();
    }
}
