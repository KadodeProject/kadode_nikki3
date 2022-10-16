<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary;

use App\Http\Controllers\Controller;
use App\UseCases\Diary\GetDiariesByYear;
use App\UseCases\StatisticPerYear\GetYearlyStatisticByYear;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class ShowYearDiaryAction extends Controller
{
    public function __construct(
        private GetYearlyStatisticByYear $getYearlyStatisticByYear,
        private GetDiariesByYear $getDiariesByYear,
    ) {
    }

    public function __invoke(int $year): View|Factory
    {
        $diaries = $this->getDiariesByYear->invoke($year);
        $statisticPerYear = $this->getYearlyStatisticByYear->invoke($year);

        return view('diary/archive/yearArchive', ['diaries' => $diaries, 'year' => $year, 'statisticPerYear' => $statisticPerYear]);
    }
}