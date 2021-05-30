<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardDiaryController extends Controller
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
        //最新2件
        $diaries= Diary::where("user_id",$user->id)->orderby("date","desc")->take(10)->get();
        return view('diary/dashboard',['user' => $user,'diaries'=>$diaries]);
    }
}