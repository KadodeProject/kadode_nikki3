<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
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
        $i=0;
        foreach ($diaries as $diary) {
            $diaries[$i]->is_latest_statistic=false;
            //統計データがあり、その統計データが日記の内容と合致しているかの判断
            if(isset($diaries[$i]->updated_statistic_at)){
                $diary_update= new Carbon($diaries[$i]->updated_at);
                $stati_update=new Carbon($diaries[$i]->updated_statistic_at);
                \Log::debug( $diary_update);
                \Log::debug($stati_update);
                \Log::debug($diary_update->gt($stati_update));

                //gtでgreater than 日付比較
                if($diaries[$i]->statistic_progress==100 && $stati_update->gt($diary_update)){
                    $diaries[$i]->is_latest_statistic=true;
                    $diaries[$i]->important_words=array_values(json_decode($diary->important_words,true));
                    $diaries[$i]->special_people=array_values(json_decode($diary->special_people,true));
                }
            }
            $i+=1;
        }

        return view('diary/archive/monthArchive',['diaries' => $diaries,'month'=>$month,'year'=>$year]);
    }
    public function getYearArchive($year)
    {

        //特定の月だけ取ってくる
        $startYear=Carbon::create($year,1,1,1,1,1)->startOfYear()->format("Y-m-d");
        $endYear=Carbon::create($year,1,1,1,1,1)->endOfYear()->format("Y-m-d");
        $diaries=Diary::where("date",">=", $startYear)->where("date","<=", $endYear)->get();

        return view('diary/archive/yearArchive',['diaries' => $diaries,'year'=>$year]);
    }
}