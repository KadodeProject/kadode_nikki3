<?php

declare(strict_types=1);

namespace Tests\Unit\UseCases\Diary;

use App\Models\Diary;
use App\UseCases\Diary\ShapeStatisticFromDiaries;
use Tests\TestCase;

class ShapeStatisticFromDiariesTest extends TestCase
{
    /** @test */
    public function コレクションを与えて、コレクションが帰ってくる()
    {
        $shapeStatisticFromDiaries = new ShapeStatisticFromDiaries();

        /** @todo 依存関係消す */
        $collection = Diary::where('user_id', 1)->get();

        $response = $shapeStatisticFromDiaries->invoke($collection);
        $this->assertInstanceOf('Illuminate\Support\Collection', $response);
    }
}