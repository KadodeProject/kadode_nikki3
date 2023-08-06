<?php

declare(strict_types=1);

namespace App\Http\ApiActions\Diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\OpenApi\Responses\OkResponse;
use Illuminate\Http\Response;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
final class DeleteDiaryAction extends Controller
{
    /**
     * idで指定された日記を削除する
     *
     * @param int $id 日記のid
     */
    #[OpenApi\Operation()]
    #[OpenApi\Response(OkResponse::class)]
    public function __invoke(int $id): void
    {
        // ログイン中のuserかの判定をしていないよいうに見えるが、グローバルスコープでやってるので弾けている
        Diary::whereId($id)->delete();
    }
}
