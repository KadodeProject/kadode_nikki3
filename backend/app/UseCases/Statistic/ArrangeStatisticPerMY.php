<?php

declare(strict_types=1);

namespace App\UseCases\Statistic;

use App\Enums\StatisticStatus;
use App\Models\Statistic;
use App\Models\StatisticPerMonth;
use App\Models\StatisticPerYear;

class ArrangeStatisticPerMY
{
    /**
     * 統計情報のチェックを行い、データを整形する
     * 統計が存在しない、存在するが処理中、存在するが古い、存在して最新の4パターン存在.
     */
    public function invoke(StatisticPerMonth|StatisticPerYear|null $statistic, StatisticStatus $statisticStatus): StatisticPerMonth|StatisticPerYear|null
    {
        return match ($statisticStatus) {
            StatisticStatus::notExist       => $this->notExist($statistic),
            StatisticStatus::generating     => $this->generating($statistic),
            StatisticStatus::outdated       => $this->outdated($statistic),
            StatisticStatus::existCorrectly => $this->existCorrectly($statistic),
        };
    }

    /**
     * @todo ここどうにかしたい
     * ほかと歩調併せてこの処理にしている
     */
    private function notExist(StatisticPerMonth|StatisticPerYear|Statistic|null $statistic): void
    {
        // voidにすることでnullを返させる(return nullはできないので)
    }

    private function generating(StatisticPerMonth|StatisticPerYear|Statistic $statistic): StatisticPerMonth|StatisticPerYear|Statistic
    {
        $statistic->statisticStatus = StatisticStatus::generating;

        return $statistic;
    }

    private function outdated(StatisticPerMonth|StatisticPerYear|Statistic $statistic): StatisticPerMonth|StatisticPerYear|Statistic
    {
        $statistic->statisticStatus = StatisticStatus::outdated;

        return $statistic;
    }

    private function existCorrectly(StatisticPerMonth|StatisticPerYear|Statistic $statistic): StatisticPerMonth|StatisticPerYear|Statistic
    {
        $statistic->statisticStatus = StatisticStatus::existCorrectly;
        // toArrayでいい感じにjson_decodeされるわけではないので、ここでjsonから配列に変換

        return $statistic;
    }
}
