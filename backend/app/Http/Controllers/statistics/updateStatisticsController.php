<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CustomFunction\calculateDiary;
class updateStatisticsController extends Controller
{
    public function __invoke()
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

            // \Log::debug("calculateDiary[month_words]");
            // \Log::debug($calculateDiary['month_words']);
            // \Log::debug("calculateDiary[month_diaries]");
            // \Log::debug($calculateDiary['month_diaries']);
            $data=[
                "user_id"=>$userId,
                "total_words"=>$calculateDiary["total_words"],
                "total_diaries"=>$calculateDiary["total_diaries"],
                'month_words'=>$calculateDiary["month_words"],//tojson外しても行ける
                'month_diaries'=>$calculateDiary["month_diaries"],//tojson外しても行ける
                'updated_at'=>$dt->addHour(24),
            
            ];

            $static->update($data);
        }
        return redirect("statistics");
    }
}