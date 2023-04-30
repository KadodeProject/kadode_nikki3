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

    /**
     * @todo JSONの中身の検証をしたいが、あまりにも複雑すぎるので一旦200だけ確認する。
     */
    public function test認証した人なら200が帰る(): void
    {
        /** @var User */
        $user = User::where('id', 1)->first();

        /**
         * @var \Illuminate\Contracts\Auth\Authenticatable
         *                                                 PHPStanのためのキャスト
         */
        $authUser = $user;

        $this->actingAs($authUser)
            ->getJson(route('GetHomeApi'))
            ->assertStatus(200);
    }

    public function test未認証だとだめ(): void
    {
        $this->getJson(route('GetHomeApi'))
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.',
            ]);
    }
}
