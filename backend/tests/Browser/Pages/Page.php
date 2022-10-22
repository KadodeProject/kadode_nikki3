<?php

declare(strict_types=1);

namespace Tests\Browser\Pages;

use Laravel\Dusk\Page as BasePage;

abstract class Page extends BasePage
{
    /**
     * Get the global element shortcuts for the site.
     */
    final public static function siteElements(): array
    {
        return [
            '@element' => '#selector',
        ];
    }
}
