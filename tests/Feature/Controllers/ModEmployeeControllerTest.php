<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ModEmployee;

use App\Models\Mod;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModEmployeeControllerTest extends TestCase
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
    public function it_displays_index_view_with_mod_employees(): void
    {
        $modEmployees = ModEmployee::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('mod-employees.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.mod_employees.index')
            ->assertViewHas('modEmployees');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_mod_employee(): void
    {
        $response = $this->get(route('mod-employees.create'));

        $response->assertOk()->assertViewIs('app.mod_employees.create');
    }

    /**
     * @test
     */
    public function it_stores_the_mod_employee(): void
    {
        $data = ModEmployee::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('mod-employees.store'), $data);

        $this->assertDatabaseHas('mod_employees', $data);

        $modEmployee = ModEmployee::latest('id')->first();

        $response->assertRedirect(route('mod-employees.edit', $modEmployee));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_mod_employee(): void
    {
        $modEmployee = ModEmployee::factory()->create();

        $response = $this->get(route('mod-employees.show', $modEmployee));

        $response
            ->assertOk()
            ->assertViewIs('app.mod_employees.show')
            ->assertViewHas('modEmployee');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_mod_employee(): void
    {
        $modEmployee = ModEmployee::factory()->create();

        $response = $this->get(route('mod-employees.edit', $modEmployee));

        $response
            ->assertOk()
            ->assertViewIs('app.mod_employees.edit')
            ->assertViewHas('modEmployee');
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

        $response = $this->put(
            route('mod-employees.update', $modEmployee),
            $data
        );

        $data['id'] = $modEmployee->id;

        $this->assertDatabaseHas('mod_employees', $data);

        $response->assertRedirect(route('mod-employees.edit', $modEmployee));
    }

    /**
     * @test
     */
    public function it_deletes_the_mod_employee(): void
    {
        $modEmployee = ModEmployee::factory()->create();

        $response = $this->delete(route('mod-employees.destroy', $modEmployee));

        $response->assertRedirect(route('mod-employees.index'));

        $this->assertModelMissing($modEmployee);
    }
}
