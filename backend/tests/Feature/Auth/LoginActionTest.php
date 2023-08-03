<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

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
        $this->postJson(route('spaLogin'), [
            'email'    => 'test1@example.com',
            'password' => 'test1234',
        ])
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Authenticated.',
            ]);
    }

    public function testログインできない(): void
    {
        $params = [
            'email'    => 'ghost@example.com',
            'password' => 'password',
        ];

        $this->postJson(route('spaLogin'), $params)
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.',
            ]);
    }

    public function test未入力チェック(): void
    {
        $this->postJson(route('spaLogin'), [])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'メールアドレスは、必ず指定してください。 (and 1 more error)',
                'errors'  => [
                    'email'    => ['メールアドレスは、必ず指定してください。'],
                    'password' => ['パスワードは、必ず指定してください。'],
                ],
            ]);
    }
}
