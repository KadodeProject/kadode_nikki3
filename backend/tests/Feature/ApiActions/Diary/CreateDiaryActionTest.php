<?php

declare(strict_types=1);

namespace Tests\Feature\ApiActions\Diary;

use App\Models\Diary;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class CreateDiaryActionTest extends TestCase
{
    use RefreshDatabase;

    public function test正しい値と認証で日記が作れる(): void
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create([
            'email' => 'testGetHomeAction@example.com',
            'password' => 'password',
        ]);

        $this->actingAs($user)
            ->postJson(
                route('CreateDiaryApi'),
                [
                    'date' => '1999-01-01',
                    'title' => 'test',
                    'content' => 'test',
                ]
            )
            ->assertStatus(200);

        $this->assertDatabaseHas('diaries', [
            'date' => '1999-01-01',
            'title' => 'test',
            'content' => 'test',
        ]);
    }

    public function test認証していないと401エラー(): void
    {
        $this->postJson(
            route('CreateDiaryApi'),
            [
                'date' => '1999-01-01',
                'title' => 'test',
                'content' => 'test',
            ]
        )
            ->assertStatus(401);
    }

    // タイトルは空でも良いので
    public function test内容が空だとエラー(): void
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create([
            'email' => 'testGetHomeAction@example.com',
            'password' => 'password',
        ]);

        $this->actingAs($user)
            ->postJson(
                route('CreateDiaryApi'),
                [
                    'date' => '1999-01-01',
                    'title' => '',
                    'content' => '',
                ]
            )
            ->assertStatus(422)
            ->assertJson([
                'message' => '本文は、必ず指定してください。',
                'errors' => [
                    'content' => [
                        '本文は、必ず指定してください。',
                    ],
                ],
            ]);
    }

    public function test日付が空だとエラー(): void
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create([
            'email' => 'testGetHomeAction@example.com',
            'password' => 'password',
        ]);

        $this->actingAs($user)
            ->postJson(
                route('CreateDiaryApi'),
                [
                    'date' => '',
                    'title' => '',
                    'content' => 'hoge',
                ]
            )
            ->assertStatus(422)
            ->assertJson([
                'message' => '日付は、必ず指定してください。',
            ]);
    }

    public function test既に存在する日付だとエラー(): void
    {
        /** @var User */
        $user = User::factory()->create([
            'email' => 'testGetHomeAction@example.com',
            'password' => 'password',
        ]);

        Diary::create(
            [
                'date' => '1999-01-01',
                'title' => 'test',
                'content' => 'test',
                'user_id' => $user->id,
                'uuid' => Str::uuid(),
            ]
        );

        /**
         * @var \Illuminate\Contracts\Auth\Authenticatable
         *                                                 PHPStanのためのキャスト
         */
        $authUser = $user;

        $this->actingAs($authUser)
            ->postJson(
                route('CreateDiaryApi'),
                [
                    'date' => '1999-01-01',
                    'title' => '',
                    'content' => 'hoge',
                ]
            )
            ->assertStatus(422)
            ->assertJson([
                'message' => '既に存在する日付の日記は作成できません',
            ]);
    }
}
