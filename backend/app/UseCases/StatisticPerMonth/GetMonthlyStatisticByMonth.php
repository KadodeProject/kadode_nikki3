<?php

declare(strict_types=1);

namespace App\UseCases\StatisticPerMonth;

use App\Models\StatisticPerMonth;
use App\UseCases\Statistic\ArrangeStatisticPerMY;
use App\UseCases\Statistic\CheckStatisticStatus;

class GetMonthlyStatisticByMonth
{
    public function __construct(
        private CheckStatisticStatus $checkStatisticStatus,
        private ArrangeStatisticPerMY $arrangeStatistic,
    ) {
    }

    /**
     * 指定された月の統計データを整えて返す.
     */
    public function invoke(int $year, int $month): array
    {
        $statisticPerMonth = StatisticPerMonth::where('year', $year)->where('month', $month)->first();
        $statisticStatus = $this->checkStatisticStatus->invoke($statisticPerMonth);
        $statisticPerMonthProceed = $this->arrangeStatistic->invoke($statisticPerMonth, $statisticStatus);
        if (null === $statisticPerMonth) {
            return [];
        }

        return $statisticPerMonthProceed->toArray();
    }
}
