<?php

declare(strict_types=1);

namespace App\UseCases\Diary;

use App\Models\Diary;
use App\UseCases\Diary\Statistic\ArrangeDiaryStatistic;
use App\UseCases\Diary\Statistic\CheckStatisticStatusByDiary;

/**
 * 指定された月と年に該当する日記を返す
 * グローバルスコープ機能でユーザーIDの絞り込みを事前に行っているため認可制御は適切.
 */
class GetDiariesByYear
{
    public function __construct(
        private CheckStatisticStatusByDiary $checkStatisticStatusByDiary,
        private ArrangeDiaryStatistic $arrangeDiaryStatistic
    ) {
    }

    /**
     * 統計データとともに日記データを返す。
     *
     * @todo Next.jsとblade混在期はResponderでtoJsonまたはtoArrayをするが、それ移行はここで加工しても良いかも？
     *
     * @return array<array>
     */
    public function invoke(int $year): array
    {
        $diaries = Diary::with('StatisticPerDate')->whereYear('date', $year)->orderby('date', 'desc')->get();

        /** ->get()だと必ずcollationが返ってくるので条件分岐不要(0の場合は内部からのcollationが来るのでループ勝手に飛ぶ) */
        $arrangedDiaries = [];
        foreach ($diaries as $diary) {
            $statisticStatus = $this->checkStatisticStatusByDiary->invoke($diary);
            $arrangedDiaries[] = $this->arrangeDiaryStatistic->invoke($diary, $statisticStatus)->toArray();
        }

        return $arrangedDiaries;
    }
}
