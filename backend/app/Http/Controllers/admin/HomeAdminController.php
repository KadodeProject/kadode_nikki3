<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\Statistic;
use App\Models\Statistic_per_month;
use App\Models\User;

class HomeAdminController extends Controller
{
    public function __invoke()
    {
        $users=User::get();
        foreach($users as $user){
            $statistic="";//怖いので初期化
            //日記数統計から取ってきていないのは統計データーがそもそも無いが、日記はある可能性があるため
            $user->diary_count=Diary::where("user_id",$user->id)->count() ?? 0;
            $user->latest_diary=Diary::where("user_id",$user->id)->first(['date'])->date ?? 'なし';
            $user->oldest_diary=Diary::where("user_id",$user->id)->orderBy("date","asc")->first(['date'])->date ?? 'なし';
            $user->statistics_per_month_count=Statistic_per_month::where("user_id",$user->id)->count() ?? 0;
            $user->diary_average="未測定";//無い可能性もあるので0に
            $statistic=Statistic::where("user_id",$user->id)->first(['total_words','total_diaries']);
            if(!empty($statistic)){
                $user->diary_average=$statistic->total_words/$statistic->total_diaries;
            }
        }

        return view('admin/homeAdmin',['users' => $users]);
    }

}