<?php

declare(strict_types=1);

namespace App\UseCases\Diary\Statistic;

use App\Enums\DiaryStatisticStatus;
use App\Models\Diary;

class ArrangeDiaryStatistic
{
    /**
     * 日記の統計情報のチェックを行い、データを整形する
     * 日記が存在しない、存在するが処理中、存在するが古い、存在して最新の4パターン存在
     */
    public function invoke(Diary $diary, DiaryStatisticStatus $statisticStatus): Diary
    {
        return match ($statisticStatus) {
            DiaryStatisticStatus::notExist => $this->notExist($diary),
            DiaryStatisticStatus::generating => $this->generating($diary),
            DiaryStatisticStatus::outdated => $this->outdated($diary),
            DiaryStatisticStatus::existCorrectly => $this->existCorrectly($diary),
        };
    }

    private function notExist(Diary $diary): Diary
    {
        $diary->statisticStatus = DiaryStatisticStatus::notExist;
        return $diary;
    }

    private function generating(Diary $diary): Diary
    {
        $diary->statisticStatus = DiaryStatisticStatus::generating;
        return $diary;
    }

    private function outdated(Diary $diary): Diary
    {
        $diary->statisticStatus = DiaryStatisticStatus::outdated;
        return $diary;
    }

    private function existCorrectly(Diary $diary): Diary
    {
        $diary->statisticStatus = DiaryStatisticStatus::existCorrectly;
        //toArrayでいい感じにjson_decodeされるわけではないので、ここでjsonから配列に変換
        $diary->statisticPerDate->important_words = array_values(json_decode($diary->statisticPerDate->important_words, true));
        $diary->statisticPerDate->special_people = array_values(json_decode($diary->statisticPerDate->special_people, true));

        return $diary;
    }
}
