<?php

declare(strict_types=1);

namespace Tests\Feature\ApiActions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class GetApiStatusActionTest extends TestCase
{
    public function test値が帰ってくる(): void
    {
        $this->getJson('/api/status')
            ->assertStatus(200)
            ->assertJson([
                'status' => '✌',
            ]);
    }

}
