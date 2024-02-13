<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\CaseCharge;

use App\Models\Mod;
use App\Models\Registrar;
use App\Models\ModEmployee;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CaseChargeControllerTest extends TestCase
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
    public function it_displays_index_view_with_case_charges(): void
    {
        $caseCharges = CaseCharge::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('case-charges.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.case_charges.index')
            ->assertViewHas('caseCharges');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_case_charge(): void
    {
        $response = $this->get(route('case-charges.create'));

        $response->assertOk()->assertViewIs('app.case_charges.create');
    }

    /**
     * @test
     */
    public function it_stores_the_case_charge(): void
    {
        $data = CaseCharge::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('case-charges.store'), $data);

        $this->assertDatabaseHas('case_charges', $data);

        $caseCharge = CaseCharge::latest('id')->first();

        $response->assertRedirect(route('case-charges.edit', $caseCharge));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_case_charge(): void
    {
        $caseCharge = CaseCharge::factory()->create();

        $response = $this->get(route('case-charges.show', $caseCharge));

        $response
            ->assertOk()
            ->assertViewIs('app.case_charges.show')
            ->assertViewHas('caseCharge');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_case_charge(): void
    {
        $caseCharge = CaseCharge::factory()->create();

        $response = $this->get(route('case-charges.edit', $caseCharge));

        $response
            ->assertOk()
            ->assertViewIs('app.case_charges.edit')
            ->assertViewHas('caseCharge');
    }

    /**
     * @test
     */
    public function it_updates_the_case_charge(): void
    {
        $caseCharge = CaseCharge::factory()->create();

        $mod = Mod::factory()->create();
        $modEmployee = ModEmployee::factory()->create();
        $registrar = Registrar::factory()->create();

        $data = [
            'modID' => $this->faker->text(255),
            'MIDnumber' => $this->faker->text(255),
            'rank' => $this->faker->text(255),
            'fullName' => $this->faker->text(255),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'crimeType' => $this->faker->text(),
            'crimeDate' => $this->faker->dateTime(),
            'chargeDate' => $this->faker->dateTime(),
            'mod_id' => $mod->id,
            'mod_employee_id' => $modEmployee->id,
            'registrar_id' => $registrar->id,
        ];

        $response = $this->put(
            route('case-charges.update', $caseCharge),
            $data
        );

        $data['id'] = $caseCharge->id;

        $this->assertDatabaseHas('case_charges', $data);

        $response->assertRedirect(route('case-charges.edit', $caseCharge));
    }

    /**
     * @test
     */
    public function it_deletes_the_case_charge(): void
    {
        $caseCharge = CaseCharge::factory()->create();

        $response = $this->delete(route('case-charges.destroy', $caseCharge));

        $response->assertRedirect(route('case-charges.index'));

        $this->assertModelMissing($caseCharge);
    }
}
