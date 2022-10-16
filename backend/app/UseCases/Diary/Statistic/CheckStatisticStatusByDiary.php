<?php

declare(strict_types=1);

namespace App\UseCases\Diary\Statistic;

use App\Enums\DiaryStatisticStatus;
use App\Models\Diary;

class CheckStatisticStatusByDiary
{
    /**
     * 日記の統計情報のチェックを行い、Enumで返す
     */
    public function invoke(Diary $diary): DiaryStatisticStatus
    {
        return match (true) {
            $diary->statisticPerDate === null => DiaryStatisticStatus::notExist,
            $diary->statisticPerDate->statistic_progress !== 100 => DiaryStatisticStatus::generating,
            $diary->statisticPerDate->updated_at < $diary->updated_at => DiaryStatisticStatus::outdated,
            //ここまでくれば確実に正しい統計データのため、trueで対処(matchにelseがないので)
            true => DiaryStatisticStatus::existCorrectly,
        };
    }
}