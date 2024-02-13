<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Registrar;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrarUsersTest extends TestCase
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
    public function it_gets_registrar_users(): void
    {
        $registrar = Registrar::factory()->create();
        $users = User::factory()
            ->count(2)
            ->create([
                'registrar_id' => $registrar->id,
            ]);

        $response = $this->getJson(
            route('api.registrars.users.index', $registrar)
        );

        $response->assertOk()->assertSee($users[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_registrar_users(): void
    {
        $registrar = Registrar::factory()->create();
        $data = User::factory()
            ->make([
                'registrar_id' => $registrar->id,
            ])
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(
            route('api.registrars.users.store', $registrar),
            $data
        );

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['current_team_id']);
        unset($data['profile_photo_path']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $user = User::latest('id')->first();

        $this->assertEquals($registrar->id, $user->registrar_id);
    }
}
