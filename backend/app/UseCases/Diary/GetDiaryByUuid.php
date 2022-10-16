<?php

declare(strict_types=1);

namespace App\UseCases\Diary;

use App\Models\Diary;
use App\UseCases\Diary\Statistic\ArrangeDiaryStatistic;
use App\UseCases\Diary\Statistic\CheckStatisticStatusByDiary;

/**
 * 日記をuuidから取得する
 * グローバルスコープ機能でユーザーIDの絞り込みを事前に行っているため認可制御は適切
 *
 */
class GetDiaryByUuid
{
    public function __construct(
        private CheckStatisticStatusByDiary $checkStatisticStatusByDiary,
        private ArrangeDiaryStatistic $arrangeDiaryStatistic
    ) {
    }
    /**
     * 統計データとともに日記データを返す。
     * @todo Next.jsとblade混在期はResponderでtoJsonまたはtoArrayをするが、それ移行はここで加工しても良いかも？
     */
    public function invoke(string $uuid): array
    {
        $diary = Diary::with('StatisticPerDate')->where("uuid", $uuid)->first();
        if ($diary instanceof Diary) {
            /** @todo ここでハイフンを年月日に変えたい*/
            $statisticStatus = $this->checkStatisticStatusByDiary->invoke($diary);
            $arrangedDiary = $this->arrangeDiaryStatistic->invoke($diary, $statisticStatus);
            return $arrangedDiary->toArray();
        } else {
            return [];
        }
    }
}