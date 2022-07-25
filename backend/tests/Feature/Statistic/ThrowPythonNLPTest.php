<?php

declare(strict_types=1);

namespace Tests\Feature\Statistic;

use App\UseCases\Statistic\ThrowPythonNLP;
use Tests\TestCase;

class ThrowPythonNLPTest extends TestCase
{
    /** @property ThrowPythonNLP */
    private $throwPythonNLPTest;

    /** @todo これはデータベースにもろ依存している。 */
    /** */
    public function testExecコマンドでpythonをエラー無く実行させる()
    {
        $this->throwPythonNLPTest = new ThrowPythonNLP();

        /**デバックありで実行(第二引数true) */
        $response = $this->throwPythonNLPTest->invoke(1, true, false);
        /**
         *  デバックありexecコマンドでNLP動くとPython側の標準出力で
         * 0 => "nlpForPre"
         * 1 => "DB接続処理開始"
         * 2 => "2スキップ"
         * 3 => "3スキップ"
         * 4 => "4スキップ"
         * 5 => "5スキップ"
         * 6 => "6スキップ"
         * 7 => "7スキップ"
         * 略
         * 322 => "DONE
         * 的なの出てくるので、最後まで実行された時のDONEを見る。
         *  */
        $this->assertContains("DONE", $response);
    }
}