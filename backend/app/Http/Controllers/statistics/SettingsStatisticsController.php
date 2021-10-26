<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\CustomNER;
use App\Models\NERLabel;
use App\Models\NlpPackageGenre;
use App\Models\NlpPackageName;
use App\Models\NlpPackageUser;
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

        //ユーザー定義固有表現ルール→ラベル名はbladeのif文で表示させるのでここではidのままでよい。
        $CustomNER=CustomNER::where('user_id',Auth::id())->get();

        //固有表現ラベル取得
        $NERLabel=NERLabel::where('id','>',0)->get()->all();
        //ラベルIDからラベル名を取得→不要

        //パッケージ取得
        $NlpPackageName=NlpPackageName::withoutGlobalScopes()->get()->all();

        //パッケージジャンル取得
        foreach($NlpPackageName as $packageObj){
            $packageObj->genre=NlpPackageGenre::where('id',$packageObj->genre_id)->get()->first()->name;
        }


        //ユーザー有効化パッケージのidを取得
        $havingPackage=[];
        $havingPackageList=NlpPackageUser::where('user_id',Auth::id())->get(['package_id']);
        foreach($havingPackageList as $havingPackageObj){
            $havingPackage[]=$havingPackageObj->package_id;
        }
        \Log::debug($havingPackage);

        return view('diary/statistics/settingsStatistics',['CustomNER' => $CustomNER,'NERLabel' =>$NERLabel,'NlpPackageName' =>$NlpPackageName,'havingPackageList' =>$havingPackage]);
    }

}