<?php

declare(strict_types=1);

namespace Tests\MinimumOperationCheck;

use Tests\TestCase;

class ShowNoLoginTest extends TestCase
{

    /** */
    public function testトップページの表示()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /** */
    public function testリリースノートの表示()
    {
        $response = $this->get('/releaseNote');
        $response->assertStatus(200);
    }
    /** */
    public function testお知らせの表示()
    {
        $response = $this->get('/osirase');
        $response->assertStatus(200);
    }
    /** */
    public function testプライバシーポリシーの表示()
    {
        $response = $this->get('/privacyPolicy');
        $response->assertStatus(200);
    }
    /** */
    public function test利用規約の表示()
    {
        $response = $this->get('/terms');
        $response->assertStatus(200);
    }
    /** */
    public function testこのサイトについて表示()
    {
        $response = $this->get('/aboutThisSite');
        $response->assertStatus(200);
    }
    /** */
    public function testお問い合わせの表示()
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }
    /** */
    public function testティーポットエラーの表示()
    {
        $response = $this->get('/teapot');
        $response->assertStatus(418);
    }
    /** */
    public function test無いページ404になる()
    {
        $response = $this->get('/hoge');
        $response->assertStatus(404);
    }
    /** */
    public function testログインしないと見れないページならログインを要求()
    {
        $response = $this->get('/home');
        $response->assertRedirect(route('login'));
    }
}
