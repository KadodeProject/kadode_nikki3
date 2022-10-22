<?php

declare(strict_types=1);

namespace Tests\MinimumOperationCheck;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class ShowLoginTest extends TestCase
{
    /**
     * A basic Integration test example.
     */
    use RefreshDatabase;

    public function testログイン済みユーザーならホーム見れる()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get(route('ShowHome'))->assertStatus(200);
    }

    public function testログイン済みユーザーなら日記作成見れる()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get(route('ShowCreateDiary'))->assertStatus(200);
    }

    public function testログイン済みユーザーならアーカイブ見れる()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get(route('ShowMonthDiary', ['year' => '2020', 'month' => '5']))->assertStatus(200);
    }

    public function testログイン済みユーザーなら検索見れる()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get(route('ShowSimpleSearch'))->assertStatus(200);
    }

    public function testログイン済みユーザーなら統計見れる()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get(route('ShowStatistic'))->assertStatus(200);
    }

    public function testログイン済みユーザーなら統計設定見れる()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get(route('ShowStatisticSetting'))->assertStatus(200);
    }

    public function testログイン済みユーザーなら設定見れる()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get(route('ShowSetting'))->assertStatus(200);
    }

    public function testログイン済みユーザーならセキュリティページで再パスワード要求される()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get(route('ShowSecurity'))->assertStatus(302);
    }

    /**
     * 下記より管理者ページ.
     */
    public function test管理ユーザーでなければ管理ページ行けない()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get('/administrator')->assertStatus(403);
    }

    public function test管理ユーザーなら管理ページ行ける()
    {
        $user = User::where('id', 1)->first();
        $response = $this->actingAs($user);
        $response->get(route('ShowAdminHome'))->assertStatus(200);
    }

    public function test管理ユーザーならパッケージ管理ページ行ける()
    {
        $user = User::where('id', 1)->first();
        $response = $this->actingAs($user);
        $response->get(route('ShowAdminPackage'))->assertStatus(200);
    }

    public function test管理ユーザーなら通知管理ページ行ける()
    {
        $user = User::where('id', 1)->first();
        $response = $this->actingAs($user);
        $response->get(route('ShowAdminNotification'))->assertStatus(200);
    }

    public function test管理ユーザーならロールとランク管理ページ行ける()
    {
        $user = User::where('id', 1)->first();
        $response = $this->actingAs($user);
        $response->get(route('ShowAdminRoleRank'))->assertStatus(200);
    }
}
