<?php

declare(strict_types=1);

namespace App\UseCases\Diary;

use App\Models\Diary;
use App\UseCases\Diary\Statistic\CheckStatisticStatusByDiary;
use App\UseCases\Diary\Statistic\ArrangeDiaryStatistic;

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
     * @todo 配列の型をPHPDocに書く
     */
    public function invoke(string $uuid): array
    {
        $diary = Diary::with('StatisticPerDate')->where("uuid", $uuid)->first();
        if ($diary instanceof Diary) {
            $statisticStatus = $this->checkStatisticStatusByDiary->invoke($diary);
            $arrangedDiary = $this->arrangeDiaryStatistic->invoke($diary, $statisticStatus);
            /** 全部文字列になるため、意図的に再代入してdateの型を補正する*/
            return $arrangedDiary->toArray();
        } else {
            return [];
        }
    }
}