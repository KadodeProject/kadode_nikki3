<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(($yesterday->diffInHours($static->updated_at))>=24){
            $diaries=Diary::where("user_id",Auth::id())->get();
            $diaryCounter=0;
            $diaryContentCharactersCounter=0;
            foreach($diaries as $diary){
                $diaryCounter+=1;
                $diaryContentCharactersCounter+=mb_strlen($diary->content);
                
            }

            $data=[
                "user_id"=>$userId,
                "total_words"=>$diaryContentCharactersCounter,
                "total_diaries"=>$diaryCounter,
                'updated_at'=>$dt,
            
            ];

            $static->update($data);
        }
        return redirect("statistics");
    }
}