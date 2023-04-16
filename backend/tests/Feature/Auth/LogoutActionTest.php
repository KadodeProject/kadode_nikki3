<?php

declare(strict_types=1);

namespace Tests\Feature\Actions\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class LogoutActionTest extends TestCase
{
    use RefreshDatabase;

    public function testログアウトできる(): void
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create(['email' => 'testLogout@example.com', 'password' => 'password']);

        $this->actingAs($user)
            ->postJson('/logout')
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Unauthenticated.',
            ]);

        $this->assertGuest();
    }

    public function testログアウト済み(): void
    {
        $this->postJson('/logout')
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Already Unauthenticated.',
            ]);

        $this->assertGuest();
    }
}
