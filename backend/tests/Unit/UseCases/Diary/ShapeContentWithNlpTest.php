<?php

declare(strict_types=1);

namespace Tests\Unit\UseCases\Diary;

use App\Models\Diary;
use App\UseCases\Diary\ShapeContentWithNlp;
use Tests\TestCase;

class ShapeContentWithNlpTest extends TestCase
{
    /** */
    public function testDiaryから配列になって帰ってくる()
    {
        return $this->markTestSkipped("現状の構成だとシーダーでNLPデータ作れないので、このテストは必ず失敗する。よってスキップ。未来に託します。");
        $shapeContentWithNlp = new ShapeContentWithNlp();

        /** @todo 依存関係消す */
        $diary = Diary::where('statistic_progress', 100)->first();

        $response = $shapeContentWithNlp->invoke($diary);
        foreach ($response as $word) {
            $this->assertArrayHasKey('lemma', $word);
            $this->assertArrayHasKey('xPOSTag', $word);
            $this->assertArrayHasKey('color', $word);
        }
    }
}