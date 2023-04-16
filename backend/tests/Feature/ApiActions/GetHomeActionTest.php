<?php

declare(strict_types=1);

namespace Tests\Feature\ApiActions;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class GetHomeActionTest extends TestCase
{
    use RefreshDatabase;

    public function testSuccess(): void
    {
        $user = User::factory()->create([
            'email' => 'testGetHomeAction@example.com',
            'password' => 'password',
        ]);

        $this->actingAs($user)
            ->getJson('/api/test')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ]);
    }

    public function testUnauthenticated(): void
    {
        $this->getJson('/api/test')
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.',
            ]);
    }
}
