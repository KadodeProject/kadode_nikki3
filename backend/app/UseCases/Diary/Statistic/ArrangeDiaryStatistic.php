<?php

declare(strict_types=1);

namespace App\UseCases\Diary\Statistic;

use App\Enums\StatisticStatus;
use App\Models\Diary;

class ArrangeDiaryStatistic
{
    /**
     * 日記の統計情報のチェックを行い、データを整形する
     * 日記が存在しない、存在するが処理中、存在するが古い、存在して最新の4パターン存在.
     */
    public function invoke(Diary $diary, StatisticStatus $statisticStatus): Diary
    {
        return match ($statisticStatus) {
            StatisticStatus::notExist       => $this->notExist($diary),
            StatisticStatus::generating     => $this->generating($diary),
            StatisticStatus::outdated       => $this->outdated($diary),
            StatisticStatus::existCorrectly => $this->existCorrectly($diary),
        };
    }

    private function notExist(Diary $diary): Diary
    {
        $diary->statisticStatus = StatisticStatus::notExist;

        return $diary;
    }

    private function generating(Diary $diary): Diary
    {
        $diary->statisticStatus = StatisticStatus::generating;

        return $diary;
    }

    private function outdated(Diary $diary): Diary
    {
        $diary->statisticStatus = StatisticStatus::outdated;

        return $diary;
    }

    private function existCorrectly(Diary $diary): Diary
    {
        $diary->statisticStatus = StatisticStatus::existCorrectly;
        // toArrayでいい感じにjson_decodeされるわけではないので、ここでjsonから配列に変換

        return $diary;
    }
}
