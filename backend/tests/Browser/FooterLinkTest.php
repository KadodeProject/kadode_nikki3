<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FooterLinkTest extends DuskTestCase
{
    public function testフッターの各種リンクが正しいページに移動するか(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('ShowTop')
                ->assertSee('リリースノート');
        });
    }
}