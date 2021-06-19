<?php

namespace App\Http\Controllers\statistics;

use App\CustomFunction\calculateDiary;
use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\Statistic;
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
            'month_words'=>$calculateDiary["month_words"],
            'month_diaries'=>$calculateDiary["month_diaries"],
        ];

        Statistic::create($data);

        return redirect("statistics");
    }
}