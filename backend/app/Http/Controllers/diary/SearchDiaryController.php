<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Illuminate\Http\Request;

class SearchDiaryController extends Controller
{
    public function post(Request $request)
    {
        //効果あるか分からないけれど、危険な変数のエスケープをする
        $request->keyword=htmlspecialchars($request->keyword, ENT_QUOTES);

        // 検索結果のバリデーション
        $rules=array(
            "keyword"=>"min:2|max:20",
            );
        $this->validate($request,$rules);

        
        //DB叩く 最近の日記から直近50個
        $diaries=Diary::where("content","like","%$request->keyword%")->orderby("date","desc")->take(50)->get();
        // \Log::debug("requests".$request->keyword);

        //文字の抽出　該当箇所の前後飲みにする
        $proceedDiary=null;
        $counter=0;
        if(!empty($diaries)){
            foreach($diaries as $diary){
                $counter+=1;
            //キーワードの長さ
            $keywordLength=mb_strlen($request->keyword);
            //日記の長さ
            $contentLength=mb_strlen($diary->content);
            //キーワードまでの文字数
            $placeOfWord=mb_strpos($diary->content,$request->keyword);
            //前後20字含めた切り出し
            //キーワードまでの文字数-20がマイナスなら0にする
            
            $placeStart=($placeOfWord -20 >=0) ?($placeOfWord -20 ):0 ;
            //検索したキーワード含めずに後ろ20字 日記の文字数オーバーしない範囲で
            $placeEnd=($placeOfWord+$keywordLength+20 <=$contentLength)?($placeOfWord+$keywordLength+20):$contentLength;
            \Log::debug("placeOfWord".$placeOfWord);
            \Log::debug("start".$placeStart);
            \Log::debug("end".$placeEnd);
            $diary->content=mb_substr($diary->content,$placeStart,$placeEnd-$placeStart);
            $proceedDiary[]=$diary;
            
            }
        }
        return view('diary/search/searchResult',['counter'=>$counter,'keyword' => $request->keyword,'diaries'=>$proceedDiary,]);
    }

    public function showSearch(){
        return view("diary/search/detailSearch");
    }
}