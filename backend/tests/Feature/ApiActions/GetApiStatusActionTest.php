<?php

declare(strict_types=1);

namespace Tests\Feature\ApiActions;

use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class GetApiStatusActionTest extends TestCase
{
    public function test✌が帰ってくる(): void
    {
        $this->getJson(route('GetApiStatus'))
            ->assertStatus(200)
            ->assertJson([
                'status' => '✌',
            ]);
    }
}
