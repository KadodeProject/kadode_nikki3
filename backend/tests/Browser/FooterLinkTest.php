<?php

declare(strict_types=1);

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class FooterLinkTest extends DuskTestCase
{
    public function testそもそもDuskが動作するか(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit('/login')
                ->assertPathIs('/login');
        });
    }

    public function testフッターのリリースノートリンクが正しく動作する(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visitRoute('ShowTop')
                ->clickLink('リリースノート')
                // route()でのURL指定だと意味がないので、遷移先の<title>で判断</title>
                ->assertTitleContains('リリースノート');
        });
    }

    public function testフッターのお知らせリンクが正しく動作する(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visitRoute('ShowTop')
                ->clickLink('お知らせ')
                // route()でのURL指定だと意味がないので、遷移先の<title>で判断</title>
                ->assertTitleContains('お知らせ');
        });
    }

    public function testフッターのトップリンクが正しく動作する(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visitRoute('ShowTop')
                ->clickLink('トップ')
                // route()でのURL指定だと意味がないので、遷移先の<title>で判断</title>
                ->assertTitleContains('トップ');
        });
    }

    public function testフッターのプライバシーポリシーリンクが正しく動作する(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visitRoute('ShowTop')
                ->clickLink('プライバシーポリシー')
                // route()でのURL指定だと意味がないので、遷移先の<title>で判断</title>
                ->assertTitleContains('プライバシーポリシー');
        });
    }

    public function testフッターの利用規約リンクが正しく動作する(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visitRoute('ShowTop')
                ->clickLink('利用規約')
                // route()でのURL指定だと意味がないので、遷移先の<title>で判断</title>
                ->assertTitleContains('利用規約');
        });
    }

    public function testフッターのこのサイトについてリンクが正しく動作する(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visitRoute('ShowTop')
                ->clickLink('このサイトについて')
                // route()でのURL指定だと意味がないので、遷移先の<title>で判断</title>
                ->assertTitleContains('このサイトについて');
        });
    }

    public function testフッターのお問い合わせリンクが正しく動作する(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visitRoute('ShowTop')
                ->clickLink('お問い合わせ')
                // route()でのURL指定だと意味がないので、遷移先の<title>で判断</title>
                ->assertTitleContains('お問い合わせ');
        });
    }
}
