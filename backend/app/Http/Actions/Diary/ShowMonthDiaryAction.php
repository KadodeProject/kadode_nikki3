<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary;

use App\Http\Controllers\Controller;
use App\UseCases\Diary\GetDiariesByMonth;
use App\UseCases\StatisticPerMonth\GetMonthlyStatisticByMonth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class ShowMonthDiaryAction extends Controller
{
    public function __construct(
        private GetMonthlyStatisticByMonth $getMonthlyStatisticByMonth,
        private GetDiariesByMonth $getDiariesByMonth,
    ) {
    }

    public function __invoke(int $year, int $month): View|Factory
    {
        $diaries = $this->getDiariesByMonth->invoke($year, $month);
        $statisticPerMonth = $this->getMonthlyStatisticByMonth->invoke($year, $month);

        return view('diary/archive/monthArchive', ['diaries' => $diaries, 'year' => $year,  'month' => $month, 'statisticPerMonth' => $statisticPerMonth]);
    }
}
