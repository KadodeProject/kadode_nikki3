<?php

declare(strict_types=1);

namespace Tests\MinimumOperationCheck;

use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class ShowNoLoginTest extends TestCase
{
    public function testトップページの表示()
    {
        $response = $this->get(route('ShowTop'));
        $response->assertStatus(200);
    }

    public function testリリースノートの表示()
    {
        $response = $this->get(route('ShowReleaseNote'));
        $response->assertStatus(200);
    }

    public function testお知らせの表示()
    {
        $response = $this->get(route('ShowOsirase'));
        $response->assertStatus(200);
    }

    public function testプライバシーポリシーの表示()
    {
        $response = $this->get(route('ShowPrivacyPolicy'));
        $response->assertStatus(200);
    }

    public function test利用規約の表示()
    {
        $response = $this->get(route('ShowTerms'));
        $response->assertStatus(200);
    }

    public function testこのサイトについて表示()
    {
        $response = $this->get(route('ShowAboutThisSite'));
        $response->assertStatus(200);
    }

    public function testお問い合わせの表示()
    {
        $response = $this->get(route('ShowContact'));
        $response->assertStatus(200);
    }

    public function testティーポットエラーの表示()
    {
        $response = $this->get(route('ShowTeapot'));
        $response->assertStatus(418);
    }

    public function test無いページ404になる()
    {
        $response = $this->get('/hoge');
        $response->assertStatus(404);
    }

    public function testログインしないと見れないページならログインを要求()
    {
        $response = $this->get(route('ShowHome'));
        $response->assertRedirect(route('login'));
    }
}
