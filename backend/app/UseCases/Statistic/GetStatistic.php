<?php

declare(strict_types=1);

namespace App\UseCases\Statistic;

use App\Models\Statistic;

class GetStatistic
{
    public function __construct(
        private CheckStatisticStatus $checkStatisticStatus,
        private ArrangeStatistic $arrangeStatistic,
    ) {
    }

    /**
     * 指定された月の統計データを整えて返す
     */
    public function invoke(int $userId): Statistic|null
    {
        $statistic = Statistic::where("user_id", $userId)->first();
        $statisticStatus = $this->checkStatisticStatus->invoke($statistic);
        $statisticPerMonthProceed = $this->arrangeStatistic->invoke($statistic, $statisticStatus);
        return $statisticPerMonthProceed;
    }
}
