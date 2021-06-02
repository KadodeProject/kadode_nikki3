<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShowDiaryController extends Controller
{
    public function getMonthArchive($year,$month)
    {

        //特定の月だけ取ってくる
        $startMonth=Carbon::create($year,$month,1,1,1,1)->startOfMonth()->format("Y-m-d");
        $endMonth=Carbon::create($year,$month,1,1,1,1)->endOfMonth()->format("Y-m-d");
        $diaries=Diary::where("date",">=", $startMonth)->where("date","<=", $endMonth)->get();

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