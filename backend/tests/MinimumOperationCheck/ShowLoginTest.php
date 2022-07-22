<?php

declare(strict_types=1);

namespace Tests\MinimumOperationCheck;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowLoginTest extends TestCase
{
    /**
     * A basic Integration test example.
     *
     * @return void
     */
    use RefreshDatabase;

    /** */
    public function testログイン済みユーザーならホーム見れる()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get('/home')->assertStatus(200);
    }
    /** */
    public function testログイン済みユーザーなら日記作成見れる()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get('/edit')->assertStatus(200);
    }
    /** */
    public function testログイン済みユーザーならアーカイブ見れる()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get('/diary/2022/5')->assertStatus(200);
    }
    /** */
    public function testログイン済みユーザーなら検索見れる()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get('/search')->assertStatus(200);
    }
    /** */
    public function testログイン済みユーザーなら統計見れる()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get('/statistics/home')->assertStatus(200);
    }
    /** */
    public function testログイン済みユーザーなら統計設定見れる()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get('/statistics/settings')->assertStatus(200);
    }
    /** */
    public function testログイン済みユーザーなら設定見れる()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get('/settings')->assertStatus(200);
    }
    /** */
    public function testログイン済みユーザーならセキュリティページで再パスワード要求される()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get('/security')->assertStatus(302);
    }

    /**
     * 下記より管理者ページ
     */
    /** */
    public function test管理ユーザーでなければ管理ページ行けない()
    {
        $user = User::where('id', 10)->first();
        $response = $this->actingAs($user);
        $response->get('/administrator')->assertStatus(403);
    }
    /** */
    public function test管理ユーザーなら管理ページ行ける()
    {
        $user = User::where('id', 1)->first();
        $response = $this->actingAs($user);
        $response->get('/administrator')->assertStatus(200);
    }
    /** */
    public function test管理ユーザーならパッケージ管理ページ行ける()
    {
        $user = User::where('id', 1)->first();
        $response = $this->actingAs($user);
        $response->get('/administrator/package')->assertStatus(200);
    }
    /** */
    public function test管理ユーザーなら通知管理ページ行ける()
    {
        $user = User::where('id', 1)->first();
        $response = $this->actingAs($user);
        $response->get('/administrator/notification')->assertStatus(200);
    }
    /** */
    public function test管理ユーザーならロールとランク管理ページ行ける()
    {
        $user = User::where('id', 1)->first();
        $response = $this->actingAs($user);
        $response->get('/administrator/role_rank')->assertStatus(200);
    }
}
