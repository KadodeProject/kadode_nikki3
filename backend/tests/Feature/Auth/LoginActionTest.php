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
final class LoginActionTest extends TestCase
{
    use RefreshDatabase;

    public function testログインできる(): void
    {
        User::factory()->create(['email' => 'test@example.com', 'password' => 'password']);

        $params = [
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $this->postJson('/login', $params)
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Authenticated.',
            ]);
    }

    public function testログインできない(): void
    {
        $params = [
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $this->postJson('/login', $params)
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.',
            ]);
    }

    public function test未入力チェック(): void
    {
        $this->postJson('/login', [])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'メールアドレスは、必ず指定してください。 (and 1 more error)',
                'errors' => [
                    'email' => ['メールアドレスは、必ず指定してください。'],
                    'password' => ['パスワードは、必ず指定してください。'],
                ],
            ]);
    }
}
