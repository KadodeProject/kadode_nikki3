<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\Statistic_per_month;
use App\Models\Statistic_per_year;
use Illuminate\Support\Carbon;
use App\CustomFunction\diaryDisplayPreProcessing;

class ShowDiaryController extends Controller
{
    public function getMonthArchive($year, $month)
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
        if ($statisticPerMonth != null) {
            if ($statisticPerMonth->statistic_progress == 100) {
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
        $diaries = diaryDisplayPreProcessing::shapeStatisticFromDiaries($diaries);

        return view('diary/archive/monthArchive', ['diaries' => $diaries, 'month' => $month, 'year' => $year, 'statisticPerMonth' => $statisticPerMonth]);
    }
    public function getYearArchive($year)
    {

        //特定の年だけ取ってくる
        $startYear = Carbon::create($year, 1, 1, 1, 1, 1)->startOfYear()->format("Y-m-d");
        $endYear = Carbon::create($year, 1, 1, 1, 1, 1)->endOfYear()->format("Y-m-d");
        $diaries = Diary::where("date", ">=", $startYear)->where("date", "<=", $endYear)->get();

        /**
         * 統計データの表示処理
         */
        //年別の統計→配列
        $statisticPerYear = Statistic_per_year::where("year", $year)->first();
        if ($statisticPerYear != null) {
            if ($statisticPerYear->statistic_progress == 100) {
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
        $diaries = diaryDisplayPreProcessing::shapeStatisticFromDiaries($diaries);

        return view('diary/archive/yearArchive', ['diaries' => $diaries, 'year' => $year, 'statisticPerYear' => $statisticPerYear]);
    }
}