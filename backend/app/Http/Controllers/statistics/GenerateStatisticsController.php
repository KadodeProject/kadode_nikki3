<?php

namespace App\Http\Controllers\statistics;

use App\CustomFunction\calculateDiary;
use App\CustomFunction\throwPython;
use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\Diary_people;
use App\Models\Statistic;
use App\Models\Statistic_overall_progress;
use App\Models\Statistic_per_month;
use App\Models\Statistic_per_year;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenerateStatisticsController extends Controller
{
    public function create(Request $request)
    {
        $diaries=Diary::orderby("date","asc")->get();
        $calculateDiary=calculateDiary::calculateDiary($diaries);


        #SQLでupdateするために先にdb insertしておく
        $data=[
            "user_id"=>Auth::id(),
            "total_words"=>$calculateDiary["total_words"],
            "total_diaries"=>$calculateDiary["total_diaries"],
        ];
        Statistic::create($data);
        $data=[
            "user_id"=>Auth::id(),
        ];
        // Statistic_per_month::create($data);
        // Statistic_per_year::create($data);
        // Diary_people::create($data);
        Statistic_overall_progress::create($data);

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
        throwPython::throwNlpToPython($userId,false,true);

        return redirect("statistics/home");
    }

    public function update(Request $request)
    {
        $dt=new Carbon();
        $yesterday= $dt->subHour(24) ;
        $userId=Auth::id();
        $static=Statistic::where("user_id",$userId)->first();
        // \Log::debug("yesterday");
        // \Log::debug($yesterday->diffInHours($static->updated_at));
        
        // 24時間以内なら更新しない
        if(($yesterday->diffInHours($static->updated_at))>=0){
            $diaries=Diary::orderby("date","asc")->get();
            $calculateDiary=calculateDiary::calculateDiary($diaries);
            //自然言語処理↓
            throwPython::throwNlpToPython($userId,false,false);

            // throwPython::throwPython("nlpForYear",$userId);
            // throwPython::throwPython("nlpForMonth",$userId);
            // throwPython::throwPython("nlpForDay",$userId);
            // \Log::debug("calculateDiary[month_words]");
            // \Log::debug($calculateDiary['month_words']);
            // \Log::debug("calculateDiary[month_diaries]");
            // \Log::debug($calculateDiary['month_diaries']);
            $data=[
                'statistic_progress'=>0,//再生成なので、一旦0にする必要がある！！！
                "user_id"=>$userId,
                //文字数と日記数
                "total_words"=>$calculateDiary["total_words"],
                "total_diaries"=>$calculateDiary["total_diaries"],
                'month_words'=>$calculateDiary["month_words"],//tojson外しても行ける
                'month_diaries'=>$calculateDiary["month_diaries"],//tojson外しても行ける
                //品詞
                // 'year_noun_asc'=>$calculateDiary["year_noun_asc"],
                // 'month_noun_asc'=>$calculateDiary["month_noun_asc"],
                // 'year_adjective_asc'=>$calculateDiary["year_adjective_asc"],
                // 'month_adjective_asc'=>$calculateDiary["month_adjective_asc"],
                'statistic_progress'=>1,
                'updated_at'=>$dt->addHour(24),
            
            ];

            $static->update($data);
        }
        return redirect("statistics/home");
    }
}