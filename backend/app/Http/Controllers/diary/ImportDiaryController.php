<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImportDiaryController extends Controller
{
    public function kadode(Request $request)
    {
        $request->kadodeCsv;
        
        //バリデーション、CSV形式であるか？
        
        
        $importResult="正しくインポートされました";
        return view("diary/io/afterImport",["importResult"=>$importResult]);
    }
    public function tukini(Request $request)
    {
        $request->tukiniTxt;
        
        return view("diary/io/afterImport",["import
    }
}