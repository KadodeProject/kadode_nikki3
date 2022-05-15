<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * デフォルトのシーダーが各テストの前に実行するかを示す
     *
     * @var bool
     */
    protected $seed = true;
}