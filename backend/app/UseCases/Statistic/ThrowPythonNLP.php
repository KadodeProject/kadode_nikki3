<?php

declare(strict_types=1);

namespace App\UseCases\Statistic;

use App\Services\Grpc\GrpcGetter;

/**
 * grpc経由でpythonに自然言語処理を投げるクラス.
 */
class ThrowPythonNLP
{
    public function __construct(
        private GrpcGetter $grpcGetter
    ) {
    }

    /**
     * 2021/9/21
     * python側で呼び出さないと、並列処理になってしまい各所でバグの温床になるので、一括実行へ変更←どういうこと？
     * $user_idの日記の自然言語処理を走らせる
     * デフォルト引数だけ変えればデバッグできるようにする
     *  $error_checkと$debugを有効にするとlaravel.logで実行結果とenv値見れるようになる.
     */
    public function invoke(int $user_id): bool
    {
        return $this->grpcGetter->getGrpcRequest($user_id);
    }
}
