<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class homeDiaryController extends Controller
{
    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function __invoke()
    {
        //ログインユーザーデーターの取得
        $user = Auth::user();
        $today_date=Carbon::today();
        $yesterday_date=Carbon::yesterday();


        /**
         * 最新10件を取って、今日と昨日があるか調べる
         * →あったら代入、
         * 
         * さらに、下で挿入するようのデータは特定文字数超えたら切って「…」にする。
         */
        $today=null;
        $yesterday=null;
        $diaries=null;
        $latests= Diary::orderby("date","desc")->take(10)->get();
        foreach($latests as $latest){
            $date=Carbon::parse($latest->date);
            if($today_date->eq($date)){
                $today=$latest;
            }else if($yesterday_date->eq($date)){
                $yesterday=$latest;
            }else{
                $diaries[]=$latest;
            }
        }

        
        $this_day=Carbon::today()->format("Y-m-d");



        /**
         * 古い日記の取得
         */
        $lastWeek=new Carbon("-1 weeks");
        $lastWeekDiary=Diary::where("date",$lastWeek->format("Y-m-d"))->first();
        $lastWeekDiary=["explain"=>"先週"]+($lastWeekDiary ?$lastWeekDiary->toArray() :["date"=>"no"]);
   
        $lastMonth=new Carbon("-1 months");
        $lastMonthDiary=Diary::where("date",$lastMonth->format("Y-m-d"))->first();
        $lastMonthDiary=["explain"=>"先月"]+($lastMonthDiary ? $lastMonthDiary->toArray() : ["date"=>"no"]);

        $lastTwoMonth=new Carbon("-2 months");
        $lastTwoMonthDiary=Diary::where("date",$lastTwoMonth->format("Y-m-d"))->first();
        $lastTwoMonthDiary=["explain"=>"2ヶ月前"]+($lastTwoMonthDiary ? $lastTwoMonthDiary->toArray() : ["date"=>"no"]);


        $halfYear=new Carbon("-6 months");
        $halfYearDiary=Diary::where("date",$halfYear->format("Y-m-d"))->first();
        $halfYearDiary=["explain"=>"半年前"]+($halfYearDiary ?$halfYearDiary->toArray() : ["date"=>"no"]);

        $lastYear=new Carbon("-1 years");
        $lastYearDiary=Diary::where("date",$lastYear->format("Y-m-d"))->first();
        $lastYearDiary=["explain"=>"1年前"]+($lastYearDiary ?$lastYearDiary->toArray() : ["date"=>"no"]);

        
        $lastTwoYear=new Carbon("-2 years");
        $lastTwoYearDiary=Diary::where("date",$lastTwoYear->format("Y-m-d"))->first();
        $lastTwoYearDiary=["explain"=>"2年前"]+($lastTwoYearDiary ?$lastTwoYearDiary->toArray() : ["date"=>"no"]);

        $lastThreeYear=new Carbon("-3 years");
        $lastThreeYearDiary=Diary::where("date",$lastThreeYear->format("Y-m-d"))->first();
        $lastThreeYearDiary=["explain"=>"3年前"]+($lastThreeYearDiary ?$lastThreeYearDiary->toArray() : ["date"=>"no"]);

        
        $oldDiaries=[$lastWeekDiary,$lastMonthDiary, $lastTwoMonthDiary,$halfYearDiary, $lastYearDiary, $lastTwoYearDiary,$lastThreeYearDiary];


        //古い日記の取得

        return view('diary/home',['user' => $user,'yesterday'=>$yesterday,'today'=>$today,'diaries'=>$diaries,'this_day'=>$this_day,'oldDiaries'=>$oldDiaries]);
    }
}