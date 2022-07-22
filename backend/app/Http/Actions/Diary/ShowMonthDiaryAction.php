<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\Statistic_per_month;
use App\UseCases\Diary\ShapeStatisticFromDiaries;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;

final class ShowMonthDiaryAction extends Controller
{
    public function __construct(
        private ShapeStatisticFromDiaries $shapeStatisticFromDiaries
    ) {
    }

        public function __invoke(int $year,int $month):View|Factory
    {

        //特定の月だけ取ってくる
        $startMonth = Carbon::create($year, $month, 1, 1, 1, 1)->startOfMonth()->format("Y-m-d");
        $endMonth = Carbon::create($year, $month, 1, 1, 1, 1)->endOfMonth()->format("Y-m-d");
        $diaries = Diary::where("date", ">=", $startMonth)->where("date", "<=", $endMonth)->get();


        /**
         * 統計データの表示処理
         */
        //月
        //月別の統計→配列
        $statisticPerMonth = Statistic_per_month::where("year", $year)->where("month", $month)->first();
        if ($statisticPerMonth !== null) {
            if ($statisticPerMonth->statistic_progress === 100) {
                $statisticPerMonth->emotions = array_values(json_decode($statisticPerMonth->emotions, true));
                $statisticPerMonth->word_counts = array_values(json_decode($statisticPerMonth->word_counts, true));
                $statisticPerMonth->noun_rank = array_values(json_decode($statisticPerMonth->noun_rank, true));
                $statisticPerMonth->adjective_rank = array_values(json_decode($statisticPerMonth->adjective_rank, true));
                $statisticPerMonth->important_words = array_values(json_decode($statisticPerMonth->important_words, true));
                $statisticPerMonth->special_people = array_values(json_decode($statisticPerMonth->special_people, true));
                $statisticPerMonth->classifications = array_values(json_decode($statisticPerMonth->classifications, true));
            }
        }

        //個別→配列の配列
        $diaries = $this->shapeStatisticFromDiaries->invoke($diaries);

        return view('diary/archive/monthArchive', ['diaries' => $diaries, 'month' => $month, 'year' => $year, 'statisticPerMonth' => $statisticPerMonth]);
    }
}
