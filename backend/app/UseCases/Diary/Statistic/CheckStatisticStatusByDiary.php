<?php

declare(strict_types=1);

namespace App\UseCases\Diary\Statistic;

use App\Enums\StatisticStatus;
use App\Models\Diary;

class CheckStatisticStatusByDiary
{
    /**
     * 日記の統計情報のチェックを行い、Enumで返す.
     */
    public function invoke(Diary $diary): StatisticStatus
    {
        return match (true) {
            null === $diary->statisticPerDate => StatisticStatus::notExist,
            100 !== $diary->statisticPerDate->statistic_progress => StatisticStatus::generating,
            $diary->statisticPerDate->updated_at < $diary->updated_at => StatisticStatus::outdated,
            // ここまでくれば確実に正しい統計データのため、trueで対処(matchにelseがないので)
            true => StatisticStatus::existCorrectly,
        };
    }
}
