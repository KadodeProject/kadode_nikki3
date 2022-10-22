<?php

declare(strict_types=1);

namespace App\UseCases\Statistic;

use App\Enums\StatisticStatus;
use App\Models\Statistic;

class ArrangeStatistic
{
    /**
     * 統計情報のチェックを行い、データを整形する
     * 統計が存在しない、存在するが処理中、存在するが古い、存在して最新の4パターン存在.
     */
    public function invoke(Statistic|null $statistic, StatisticStatus $statisticStatus): Statistic|null
    {
        return match ($statisticStatus) {
            StatisticStatus::notExist => $this->notExist($statistic),
            StatisticStatus::generating => $this->generating($statistic),
            StatisticStatus::outdated => $this->outdated($statistic),
            StatisticStatus::existCorrectly => $this->existCorrectly($statistic),
        };
    }

    /**
     * @todo ここどうにかしたい
     * ほかと歩調併せてこの処理にしている
     */
    private function notExist(Statistic|null $statistic): void
    {
        // voidにすることでnullを返させる(return nullはできないので)
    }

    private function generating(Statistic $statistic): Statistic
    {
        $statistic->statisticStatus = StatisticStatus::generating;

        return $statistic;
    }

    private function outdated(Statistic $statistic): Statistic
    {
        $statistic->statisticStatus = StatisticStatus::outdated;

        return $statistic;
    }

    private function existCorrectly(Statistic $statistic): Statistic
    {
        $statistic->statisticStatus = StatisticStatus::existCorrectly;
        // toArrayでいい感じにjson_decodeされるわけではないので、ここでjsonから配列に変換

        $statistic->total_noun_asc = array_values(json_decode($statistic->total_noun_asc, true));
        $statistic->total_adjective_asc = array_values(json_decode($statistic->total_adjective_asc, true));
        $statistic->emotions = array_values(json_decode($statistic->emotions, true));
        $statistic->special_people = array_values(json_decode($statistic->special_people, true));
        $statistic->classifications = array_values(json_decode($statistic->classifications, true));
        $statistic->important_words = array_values(json_decode($statistic->important_words, true));
        $statistic->months = array_keys(json_decode($statistic->month_words, true));
        $statistic->month_words = array_values(json_decode($statistic->month_words, true));
        $statistic->month_diaries = array_values(json_decode($statistic->month_diaries, true));

        return $statistic;
    }
}
