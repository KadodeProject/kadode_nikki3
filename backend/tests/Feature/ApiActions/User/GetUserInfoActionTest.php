<?php

declare(strict_types=1);

namespace Tests\Feature\ApiActions\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class GetUserInfoActionTest extends TestCase
{
    use RefreshDatabase;

    public function test認証した人のと名前が帰ってくる(): void
    {
        /** @var User */
        $user = User::factory()->create([
            'name' => 'testUser',
            'email' => 'testGetHomeAction@example.com',
            'password' => 'password',
        ]);

        /**
         * @var \Illuminate\Contracts\Auth\Authenticatable
         *                                                 PHPStanのためのキャスト
         */
        $authUser = $user;

        $this->actingAs($authUser)
            ->getJson(route('getUserInfo'))
            ->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name,
            ]);
    }

    public function test認証していないと401エラー(): void
    {
        $this->getJson(route('getUserInfo'))
            ->assertStatus(401);
    }
}
