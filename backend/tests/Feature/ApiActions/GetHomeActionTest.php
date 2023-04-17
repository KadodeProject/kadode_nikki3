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

    public function test値が帰ってくる(): void
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create([
            'email' => 'testGetHomeAction@example.com',
            'password' => 'password',
        ]);

        $this->actingAs($user)
            ->getJson('/api/test')
            ->assertStatus(200)
            ->assertJson([
                    'id' => $user->id ?? null,
                    'name' => $user->name ?? null,
                    'email' => $user->email ?? null,
            ]);
    }

    public function test未認証だとだめ(): void
    {
        $this->getJson('/api/test')
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.',
            ]);
    }
}
