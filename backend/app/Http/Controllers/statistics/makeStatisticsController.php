<?php

namespace App\Http\Controllers\statistics;

use App\CustomFunction\calculateDiary;
use App\CustomFunction\throwPython;
use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class makeStatisticsController extends Controller
{
    public function __invoke()
    {
        $diaries=Diary::orderby("date","asc")->get();
        $calculateDiary=calculateDiary::calculateDiary($diaries);


        $data=[
            "user_id"=>Auth::id(),
            "total_words"=>$calculateDiary["total_words"],
            "total_diaries"=>$calculateDiary["total_diaries"],
        ];

        Statistic::create($data);

        //なぜか初回生成でjson投げると怒られる。
        //すごく汚いコードだが、初回生成して、もう1度データ投げる方式
        


        $userId=Auth::id();
        $dt=new Carbon();
        $data=[
            "user_id"=>$userId,
            "total_words"=>$calculateDiary["total_words"],
            "total_diaries"=>$calculateDiary["total_diaries"],
            'month_words'=>$calculateDiary["month_words"],//tojson外しても行ける
            'month_diaries'=>$calculateDiary["month_diaries"],//tojson外しても行ける
            // 'year_noun_asc'=>$calculateDiary["year_noun_asc"],
            // 'month_noun_asc'=>$calculateDiary["month_noun_asc"],
            // 'year_adjective_asc'=>$calculateDiary["year_adjective_asc"],
            // 'month_adjective_asc'=>$calculateDiary["month_adjective_asc"],
            'updated_at'=>$dt,
            'statistic_progress'=>1,
        
        ];

        Statistic::where("user_id",$userId)->update($data);


        /**
         * ここからPython
         */
    
        throwPython::throwPython("nlpForPre",$userId,false,true);
        throwPython::throwPython("nlpForTotal",$userId,false,true);

        return redirect("statistics");
    }
}