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
class GetLatestDiaries
{
    public function __construct(
        private CheckStatisticStatusByDiary $checkStatisticStatusByDiary,
        private ArrangeDiaryStatistic $arrangeDiaryStatistic
    ) {
    }
    /**
     * 統計データとともに日記データを返す。
     * @todo Next.jsとblade混在期はResponderでtoJsonまたはtoArrayをするが、それ移行はここで加工しても良いかも？
     * @return array<array>
     */
    public function invoke(): array
    {
        $diaries = Diary::with('StatisticPerDate')->orderby("date", "desc")->take(10)->get();
        /** ->get()だと必ずcollationが返ってくるので条件分岐不要(0の場合は内部からのcollationが来るのでループ勝手に飛ぶ) */
        $arrangedDiaries = [];
        foreach ($diaries as $diary) {
            $statisticStatus = $this->checkStatisticStatusByDiary->invoke($diary);
            /** @todo laravelの仕様上UTCに勝手に変換して日付も変えるのでここで戻す処理を走らせる */
            $jstDiaryDate = $diary->date->format('Y-m-d');
            $arrangedDiaryToArray = $this->arrangeDiaryStatistic->invoke($diary, $statisticStatus)->toArray();
            $arrangedDiaryToArray['date'] = $jstDiaryDate;
            $arrangedDiaries[] = $arrangedDiaryToArray;
        }
        return $arrangedDiaries;
    }
}