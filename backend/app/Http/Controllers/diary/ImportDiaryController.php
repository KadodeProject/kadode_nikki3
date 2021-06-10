<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Illuminate\Http\Request;

//csvインポート用
use Goodby\CSV\Import\Standard\LexerConfig;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ImportDiaryController extends Controller
{
    public function kadode(Request $request)
    {
       ;
        
        //バリデーション、CSV形式、1M以内のファイル
        $rules=array(
            // "kadodeCsv"=>"file|max:1000|mimes:csv",
            );
        $this->validate($request,$rules);


                // CSV ファイル保存
                $count = 0;
                if($rawfile=$request->kadodeCsv){
            \Log::debug("messageインポート処理開始");
          
            $tmpName = mt_rand().".".$request->kadodeCsv->guessExtension(); //TMPファイル名
            $request->kadodeCsv->move(public_path()."/importCsv",$tmpName);
            $tmpPath = public_path()."/importCsv/".$tmpName;
        
            //Goodby CSVのconfig設定
            $config = new LexerConfig();
            $interpreter = new Interpreter();
            $lexer = new Lexer($config);
        
            //CharsetをUTF-8に変換、CSVのヘッダー行を無視
            $config->setToCharset("UTF-8");
            $config->setFromCharset("sjis-win");
            $config->setIgnoreHeaderLine(true);
        
            $dataList = [];
            
            // 新規Observerとして、$dataList配列に値を代入
            $interpreter->addObserver(function (array $row) use (&$dataList){
                // 各列のデータを取得
                $dataList[] = $row;
            });
        
            // CSVデータをパース
            $lexer->parse($tmpPath, $interpreter);
        
            // TMPファイル削除
            if (unlink($tmpPath)){
                // echo $file.'の削除に成功しました。';
                \Log::debug("$tmpPath.の削除成功");
            }else{
                  \Log::debug("$filetmpPath.の削除失敗");
              }

        
            // 登録処理
            foreach($dataList as $row){
                Diary::insert(['user_id'=>Auth::Id(),'uuid'=>Str::uuid(), 'date' => $row[0], 'title' => $row[1], 'feel' => $row[2],'content' => $row[3]]);
                $count++;
            }
        
        }
        
        $importResult=$count."件が正しくインポートされました";
        return view("diary/io/afterImport",["importResult"=>$importResult]);
    }
    public function tukini(Request $request)
    {
        $request->tukiniTxt;
        //バリデーション、txt形式、1M以内のファイル
        $rules=array(
            "tukiniTxt"=>"file|max:1000|mimes:txt",
            );
        $importResult="正しくインポートされました";
        return view("diary/io/afterImport",["importResult"=>$importResult]);
    }
}