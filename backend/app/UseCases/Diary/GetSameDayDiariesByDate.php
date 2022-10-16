<?php

declare(strict_types=1);

namespace App\UseCases\Diary;

use App\Models\Diary;
use App\UseCases\Diary\Statistic\ArrangeDiaryStatistic;
use App\UseCases\Diary\Statistic\CheckStatisticStatusByDiary;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class GetSameDayDiariesByDate
{
    public function __construct(
        private CheckStatisticStatusByDiary $checkStatisticStatusByDiary,
        private ArrangeDiaryStatistic $arrangeDiaryStatistic
    ) {
    }
    /**
     * 年が違う同じ日の日記を返す
     * @todo Next.jsとblade混在期はResponderでtoJsonまたはtoArrayをするが、それ移行はここで加工しても良いかも？
     * @return array<Diary>
     */
    public function invoke(Carbon|CarbonImmutable $date): array
    {
        $diaries = Diary::with('StatisticPerDate')->whereMonth('date', $date->month)->whereDay('date', $date->day)->orderby("date", "desc")->get();
        /** ->get()だと必ずcollationが返ってくるので条件分岐不要(0の場合は内部からのcollationが来るのでループ勝手に飛ぶ) */
        $arrangedDiaries = [];
        foreach ($diaries as $diary) {
            $statisticStatus = $this->checkStatisticStatusByDiary->invoke($diary);
            $arrangedDiaries[] = $this->arrangeDiaryStatistic->invoke($diary, $statisticStatus)->toArray();
        }
        return $arrangedDiaries;
    }
}