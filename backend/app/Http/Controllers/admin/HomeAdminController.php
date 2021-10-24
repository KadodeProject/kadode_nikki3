<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\NERLabel;
use App\Models\NlpPackageGenre;
use App\Models\NlpPackageName;
use App\Models\PackageNER;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    public function __invoke()
    {
        //パッケージ表示
        $NlpPackageName=NlpPackageName::get();
        //パッケージジャンル表示
        $NlpPackageGenre=NlpPackageGenre::get();
        
        //固有表現ルールの中身取得
        $packageNERWrapper=[];
        foreach($NlpPackageName as $NlpPackageObj){
            if( $NlpPackageObj->genre_id==1){
                //固有表現パッケージだったら
                $packageNER=PackageNER::where('package_id',$NlpPackageObj->id)->get();
                $packageNERWrapper={
                    "packageNER"->"$packageNER,
                    "packageNER"->"$packageNER,
                }

            }

        }

        //固有表現ラベル取得
        $NERLabel=NERLabel::where('id','>',0)->get();
        return view('diary/admin/homeAdmin',['NlpPackageName' => $NlpPackageName,'NlpPackageGenre' =>$NlpPackageGenre,'NERLabel' =>$NERLabel,]);

    }
}