<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShowDiaryController extends Controller
{
    public function __invoke($year,$month)
    {

        //特定の月だけ取ってくる
        $startMonth=Carbon::create($year,$month,1,1,1,1)->startOfMonth()->format("Y-m-d");
        $endMonth=Carbon::create($year,$month,1,1,1,1)->endOfMonth()->format("Y-m-d");
        $diaries=Diary::where("date",">=", $startMonth)->where("date","<=", $endMonth)->take(31)->get();

        return view('diary/monthArchive',['diaries' => $diaries,'month'=>$month,'year'=>$year]);
    }
}