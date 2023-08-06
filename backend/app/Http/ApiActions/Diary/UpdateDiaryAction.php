<?php

declare(strict_types=1);

namespace App\Http\ApiActions\Diary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Diary\DiaryRequest;
use App\Models\Diary;
use App\OpenApi\RequestBodies\Diary\DiaryRequsetBody;
use App\OpenApi\Responses\OkResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
final class UpdateDiaryAction extends Controller
{
    /**
     * 指定された日付の日記を更新する
     *
     * @param string $date 日記の日付
     */
    #[OpenApi\Operation()]
    #[OpenApi\RequestBody(DiaryRequsetBody::class)]
    #[OpenApi\Response(OkResponse::class)]
    public function __invoke(string $date, DiaryRequest $request): void
    {
        // グローバルスコープでログイン中のユーザーであることは確認済み
        $diary = Diary::where('date', $date)->first();
        if ($diary !== null) {
            // 同じならupdated_atを更新しなくて良いのでupdateでなくsaveを使う
            $diary->save([
                'title'   => $request->title,
                'content' => $request->content,
                'date'    => $request->date,
            ]);
        }
        // 日記が存在しない場合どうするか？
        // 起こりうるケースは表示→削除ボタン押すまでに別のログイン中の端末から消すとかなので、何もしないで良い気がする
    }
}
