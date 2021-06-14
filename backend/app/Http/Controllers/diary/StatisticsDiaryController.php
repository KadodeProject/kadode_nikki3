<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsDiaryController extends Controller
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
        return view("diary/statistics/statisticsTop",["statistics"=>$statistic]);
    }
}