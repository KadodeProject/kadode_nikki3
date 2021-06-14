<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class makeStatisticsController extends Controller
{
    public function __invoke()
    {
        $diaries=Diary::where("user_id",Auth::id())->get();
        $diaryCounter=0;
        $diaryContentCharactersCounter=0;
        foreach($diaries as $diary){
            $diaryCounter+=1;
            $diaryContentCharactersCounter+=mb_strlen($diary->content);
            
        }

        $data=[
            "user_id"=>Auth::id(),
            "total_words"=>$diaryContentCharactersCounter,
            "total_diaries"=>$diaryCounter,
           
        ];

        Statistic::create($data);

        return redirect("statistics");
    }
}