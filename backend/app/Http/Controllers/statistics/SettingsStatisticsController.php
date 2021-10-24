<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\CustomNER;
use App\Models\NERLabel;
use Illuminate\Support\Facades\Auth;

class SettingsStatisticsController extends Controller
{
    /**
     * Undocumented function
     *
     * @param [type] $uuid
     * @return void
     */
    public function get(){

        // $diary=Diary::where("uuid",$uuid)->first();
        // if($diary==null){
        //     //日記無かったらリダイレクトさせる
        //     return redirect("home");
        // }
        // $next=Diary::where("date",">",$diary->date)->orderBy("date","asc")->first();
        // $previous=Diary::where("date","<",$diary->date)->orderBy("date","desc")->first();

        // //日記の統計情報取得
        // $diary->is_latest_statistic=false;
        // $diary_update= new Carbon($diary->updated_at);
        // $stati_update=new Carbon($diary->updated_statistic_at);

        // //最新の情報のときのみ
        // if($diary->statistic_progress==100 && $stati_update->gt($diary_update)){
        //     /**
        //      * 名詞と形容詞の登場順
        //      */
        //     //jsonを配列に戻し、連想配列を配列にする
        //     $diary->is_latest_statistic=true;
        //     $diary->important_words=array_values(json_decode($diary->important_words,true));
        //     $diary->special_people=array_values(json_decode($diary->special_people,true));
        // }

        //ユーザー定義固有表現ルール→ラベル名はbladeのif文で表示させるのでここではidのままでよい。
        $CustomNER=CustomNER::where('user_id',Auth::id())->get();
        
        //固有表現ラベル取得
        $NERLabel=NERLabel::where('id','>',0)->get()->all();
        //ラベルIDからラベル名を取得→不要

        //ユーザー有効化パッケージ

        return view('diary/statistics/settingsStatistics',['CustomNER' => $CustomNER,'NERLabel' =>$NERLabel]);
    }

}