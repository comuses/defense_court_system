<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Witness;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WitnessTest extends TestCase
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
    public function it_gets_witnesses_list(): void
    {
        $witnesses = Witness::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.witnesses.index'));

        $response->assertOk()->assertSee($witnesses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_witness(): void
    {
        $data = Witness::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.witnesses.store'), $data);

        $this->assertDatabaseHas('witnesses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_witness(): void
    {
        $witness = Witness::factory()->create();

        $data = [
            'witnessID' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'attorneyWitness' => $this->faker->text(255),
            'Description' => $this->faker->sentence(15),
            'accusedWitness' => $this->faker->text(255),
            'attoneyID' => $this->faker->text(255),
            'caseChargedID' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.witnesses.update', $witness),
            $data
        );

        $data['id'] = $witness->id;

        $this->assertDatabaseHas('witnesses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_witness(): void
    {
        $witness = Witness::factory()->create();

        $response = $this->deleteJson(route('api.witnesses.destroy', $witness));

        $this->assertModelMissing($witness);

        $response->assertNoContent();
    }
}
