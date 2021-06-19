<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class showStatisticsController extends Controller
{
    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function __invoke()
    {
        $statistic=Statistic::where("user_id",Auth::id())->first() ;
        \Log::debug("message");
        \Log::debug($statistic->month_words);
        //配列のキーから月を取得
        $statistic->months=array_keys(json_decode($statistic->month_words,true));
        //jsonを配列に戻し、連想配列を配列にする
        $statistic->month_words=array_values(json_decode($statistic->month_words,true));
        $statistic->month_diaries=array_values(json_decode($statistic->month_diaries,true));
        //月当たりの平均文字数にする(月の合計文字数わる日記数)
        $tmp=[];
        $statistic_month_diaries=$statistic->month_diaries;//一度変数に代入しないと怒られるのでこうしている。
        $i=0;
        foreach ($statistic->month_words as $month_word){
            array_push($tmp,$month_word/($statistic_month_diaries[$i]));
            $i+=1;
        }
        $statistic->month_words_per_diary=$tmp;
//         month_words
// month_diaries
// year_words
// year_diaries
// year_noun_asc
// month_noun_asc
// year_adjective_asc
// month_adjective_asc

        return view("diary/statistics/statisticsTop",["statistics"=>$statistic]);
    }
}