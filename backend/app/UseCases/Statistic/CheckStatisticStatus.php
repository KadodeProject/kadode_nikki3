<?php

declare(strict_types=1);

namespace App\UseCases\Statistic;

use App\Enums\StatisticStatus;
use App\Models\Statistic;
use App\Models\StatisticPerMonth;
use App\Models\StatisticPerYear;

/**
 * まとまった統計データの統計情報チェックを行う
 */
class CheckStatisticStatus
{
    /**
     * 統計情報のチェックを行い、Enumで返す
     */
    public function invoke(StatisticPerMonth|StatisticPerYear|Statistic|null $statistic): StatisticStatus
    {
        return match (true) {
            $statistic === null => StatisticStatus::notExist,
            $statistic->statistic_progress !== 100 => StatisticStatus::generating,
            /**
             * 最新でないかはその月または年のすべての日記の更新日時を比較する必要があり、重さの割にリターンが少ないので探さない
             * @todo 最新でないも判別できるようにする
             * StatisticStatus::outdated
             */
            //ここまでくれば確実に正しい統計データのため、trueで対処(matchにelseがないので)
            true => StatisticStatus::existCorrectly,
        };
    }
}