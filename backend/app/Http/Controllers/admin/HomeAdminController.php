<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\NERLabel;
use App\Models\NlpPackageGenre;
use App\Models\NlpPackageName;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    public function __invoke()
    {
        //パッケージ表示
        $NlpPackageName=NlpPackageName::get();
        //パッケージ表示
        $NlpPackageGenre=NlpPackageGenre::get();

        //固有表現ラベル取得
        $NERLabel=NERLabel::where('id','>',0)->get();
        return view('diary/admin/homeAdmin',['NlpPackageName' => $NlpPackageName,'NlpPackageGenre' =>$NlpPackageGenre,'NERLabel' =>$NERLabel,]);

    }
}