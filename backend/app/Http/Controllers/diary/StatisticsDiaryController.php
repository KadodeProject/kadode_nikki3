<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view("diary/statistics/statisticsTop");
    }
}