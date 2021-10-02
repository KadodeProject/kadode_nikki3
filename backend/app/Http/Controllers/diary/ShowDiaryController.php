<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\Statistic_per_month;
use App\Models\Statistic_per_year;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShowDiaryController extends Controller
{
    public function getMonthArchive($year,$month)
    {

        //特定の月だけ取ってくる
        $startMonth=Carbon::create($year,$month,1,1,1,1)->startOfMonth()->format("Y-m-d");
        $endMonth=Carbon::create($year,$month,1,1,1,1)->endOfMonth()->format("Y-m-d");
        $diaries=Diary::where("date",">=", $startMonth)->where("date","<=", $endMonth)->get();


        /**
         * 統計データの表示処理
         */
        //月
        //月別の統計→配列
        $statisticPerMonth=Statistic_per_month::where("year",$year)->where("month",$month)->first();
        if($statisticPerMonth!=null){
            if($statisticPerMonth->statistic_progress==100 ){
                $statisticPerMonth->emotions=array_values(json_decode($statisticPerMonth->emotions,true));
                $statisticPerMonth->word_counts=array_values(json_decode($statisticPerMonth->word_counts,true));
                $statisticPerMonth->noun_rank=array_values(json_decode($statisticPerMonth->noun_rank,true));
                $statisticPerMonth->adjective_rank=array_values(json_decode($statisticPerMonth->adjective_rank,true));
                $statisticPerMonth->important_words=array_values(json_decode($statisticPerMonth->important_words,true));
                $statisticPerMonth->special_people=array_values(json_decode($statisticPerMonth->special_people,true));
                $statisticPerMonth->classifications=array_values(json_decode($statisticPerMonth->classifications,true));
            }
        }
    
         //個別→配列の配列
        $i=0;
        foreach ($diaries as $diary) {
            $diaries[$i]->is_latest_statistic=false;
            //統計データがあり、その統計データが日記の内容と合致しているかの判断
            if(isset($diaries[$i]->updated_statistic_at)){
                $diary_update= new Carbon($diaries[$i]->updated_at);
                $stati_update=new Carbon($diaries[$i]->updated_statistic_at);
                //gtでgreater than 日付比較
                if($diaries[$i]->statistic_progress==100 && $stati_update->gt($diary_update)){
                    $diaries[$i]->is_latest_statistic=true;
                    $diaries[$i]->important_words=array_values(json_decode($diary->important_words,true));
                    $diaries[$i]->special_people=array_values(json_decode($diary->special_people,true));
                }
            }
            $i+=1;
        }
        //統計データの表示処理ここまで

        return view('diary/archive/monthArchive',['diaries' => $diaries,'month'=>$month,'year'=>$year,'statisticPerMonth'=>$statisticPerMonth]);
    }
    public function getYearArchive($year)
    {

        //特定の月だけ取ってくる
        $startYear=Carbon::create($year,1,1,1,1,1)->startOfYear()->format("Y-m-d");
        $endYear=Carbon::create($year,1,1,1,1,1)->endOfYear()->format("Y-m-d");
        $diaries=Diary::where("date",">=", $startYear)->where("date","<=", $endYear)->get();

        /**
         * 統計データの表示処理
         */
        //月別の統計→配列
        $statisticPerYear=Statistic_per_year::where("year",$year)->first();
        if($statisticPerYear!=null){
            if($statisticPerYear->statistic_progress==100 ){
                $statisticPerYear->emotions=array_values(json_decode($statisticPerYear->emotions,true));
                $statisticPerYear->word_counts=array_values(json_decode($statisticPerYear->word_counts,true));
                $statisticPerYear->noun_rank=array_values(json_decode($statisticPerYear->noun_rank,true));
                $statisticPerYear->adjective_rank=array_values(json_decode($statisticPerYear->adjective_rank,true));
                $statisticPerYear->important_words=array_values(json_decode($statisticPerYear->important_words,true));
                $statisticPerYear->special_people=array_values(json_decode($statisticPerYear->special_people,true));
                $statisticPerYear->classifications=array_values(json_decode($statisticPerYear->classifications,true));
            }
        }
        //個別
        $i=0;
        foreach ($diaries as $diary) {
            $diaries[$i]->is_latest_statistic=false;
            //統計データがあり、その統計データが日記の内容と合致しているかの判断
            if(isset($diaries[$i]->updated_statistic_at)){
                $diary_update= new Carbon($diaries[$i]->updated_at);
                $stati_update=new Carbon($diaries[$i]->updated_statistic_at);
                //gtでgreater than 日付比較
                if($diaries[$i]->statistic_progress==100 && $stati_update->gt($diary_update)){
                    $diaries[$i]->is_latest_statistic=true;
                    $diaries[$i]->important_words=array_values(json_decode($diary->important_words,true));
                    $diaries[$i]->special_people=array_values(json_decode($diary->special_people,true));
                }
            }
            $i+=1;
        }
        //統計データの表示処理ここまで

        return view('diary/archive/yearArchive',['diaries' => $diaries,'year'=>$year,'statisticPerYear'=>$statisticPerYear]);
    }
}