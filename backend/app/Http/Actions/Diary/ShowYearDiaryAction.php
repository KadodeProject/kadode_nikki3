<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\StatisticPerYear;
use App\UseCases\Diary\ShapeStatisticFromDiaries;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;

final class ShowYearDiaryAction extends Controller
{
    public function __construct(
        private ShapeStatisticFromDiaries $shapeStatisticFromDiaries
    ) {
    }

    public function __invoke(int $year): View|Factory
    {
        //特定の年だけ取ってくる
        $startYear = Carbon::create($year, 1, 1, 1, 1, 1)->startOfYear()->format("Y-m-d");
        $endYear = Carbon::create($year, 1, 1, 1, 1, 1)->endOfYear()->format("Y-m-d");
        $diaries = Diary::where("date", ">=", $startYear)->where("date", "<=", $endYear)->get();

        /**
         * 統計データの表示処理
         */
        //年別の統計→配列
        $statisticPerYear = StatisticPerYear::where("year", $year)->first();
        if ($statisticPerYear !== null) {
            if ($statisticPerYear->statistic_progress === 100) {
                $statisticPerYear->emotions = array_values(json_decode($statisticPerYear->emotions, true));
                $statisticPerYear->word_counts = array_values(json_decode($statisticPerYear->word_counts, true));
                $statisticPerYear->noun_rank = array_values(json_decode($statisticPerYear->noun_rank, true));
                $statisticPerYear->adjective_rank = array_values(json_decode($statisticPerYear->adjective_rank, true));
                $statisticPerYear->important_words = array_values(json_decode($statisticPerYear->important_words, true));
                $statisticPerYear->special_people = array_values(json_decode($statisticPerYear->special_people, true));
                $statisticPerYear->classifications = array_values(json_decode($statisticPerYear->classifications, true));
            }
        }
        //個別
        $diaries = $this->shapeStatisticFromDiaries->invoke($diaries);

        return view('diary/archive/yearArchive', ['diaries' => $diaries, 'year' => $year, 'statisticPerYear' => $statisticPerYear]);
    }
}
