<?php

declare(strict_types=1);

namespace App\Http\ApiActions\Diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\OpenApi\Responses\Diary\DiaryResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\UseCases\Diary\Statistic\ArrangeDiaryStatistic;
use App\UseCases\Diary\Statistic\CheckStatisticStatusByDiary;
use Illuminate\Http\Resources\Json\JsonResource;

#[OpenApi\PathItem]
final class ReadDiaryAction extends Controller
{
    public function __construct(
        private CheckStatisticStatusByDiary $checkStatisticStatusByDiary,
        private ArrangeDiaryStatistic $arrangeDiaryStatistic
    ) {
    }

    /**
     * 指定された日付の日記を取得する
     *
     * @param string $date 日記の日付
     */
    #[OpenApi\Operation()]
    #[OpenApi\Response(DiaryResponse::class)]
    public function __invoke(string $date): JsonResource
    {
        // ログイン中のuserかの判定をしていないよいうに見えるが、グローバルスコープでやってるので弾けている
        $diary = Diary::with(['statisticPerDate', 'diaryProcessed'])->where('date', $date)->first();
        if ($diary === null) {
            abort(404, '指定された日記は存在しません');
        }
        $statisticStatus = $this->checkStatisticStatusByDiary->invoke($diary);

        return new JsonResource($this->arrangeDiaryStatistic->invoke($diary, $statisticStatus));
    }
}
