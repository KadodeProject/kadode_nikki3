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
         */
        $today=null;
        $yesterday=null;
        $diaries=null;
        $latests= Diary::where("user_id",$user->id)->orderby("date","desc")->take(10)->get();
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

        //最新10件、ただし直近で取れた日記は除く
        return view('diary/home',['user' => $user,'yesterday'=>$yesterday,'today'=>$today,'diaries'=>$diaries]);
    }
}