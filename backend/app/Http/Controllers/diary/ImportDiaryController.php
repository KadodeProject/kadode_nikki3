<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

//csvインポート用
use Goodby\CSV\Import\Standard\LexerConfig;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * @todo ここDRYにめちゃくちゃ反してるのでインターフェイス作って抽象化したい
 */
class ImportDiaryController extends Controller
{
    /**
     * かどで日記インポート機能
     *
     * @param Request $request
     * @return void
     */
    public function kadode(Request $request)
    {

        //バリデーション、CSV形式、1M以内のファイル
        //csvだけだと何故かエラー出るので、やむをえず、txtも。 .csv認識できてないっぽい
        $rules = array(
            "kadodeCsv" => "file|max:2000|mimes:csv,txt",
        );
        $this->validate($request, $rules);


        // CSV ファイル保存
        $count = 0;
        if ($request->kadodeCsv) {
            \Log::debug("csvインポート処理開始");

            $tmpName = mt_rand() . "." . $request->kadodeCsv->guessExtension(); //TMPファイル名
            $request->kadodeCsv->move(public_path() . "/importCsv", $tmpName);
            $tmpPath = public_path() . "/importCsv/" . $tmpName;

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
            $interpreter->addObserver(function (array $row) use (&$dataList) {
                // 各列のデータを取得
                $dataList[] = $row;
            });

            // CSVデータをパース
            $lexer->parse($tmpPath, $interpreter);

            // TMPファイル削除
            if (unlink($tmpPath)) {
                // echo $file.'の削除に成功しました。';
                \Log::debug("$tmpPath.の削除成功");
            } else {
                \Log::debug("$tmpPath.の削除失敗");
            }
            $today_date = Carbon::now();
            // 登録処理
            foreach ($dataList as $row) {
                Diary::insert(['updated_at' => $today_date, 'created_at' => $today_date, 'user_id' => Auth::Id(), 'uuid' => Str::uuid(), 'date' => Carbon::parse($row[0])->toDateString(), 'title' => $row[1], 'content' => $row[2]]);
                $count++;
            }
            $importResult = $count . "個の日記がインポートされました🎉";
        } else {
            $importResult = "ファイルが見つかりませんでした😢";
        }

        return view("diary/io/afterImport", ["importResult" => $importResult]);
    }


    /**
     * 月に書く日記インポート機能
     *
     * @param Request $request
     * @return void
     */
    public function tukini(Request $request)
    {
        // $request->tukiniTxt;
        //バリデーション、txt形式、1M以内のファイル
        $rules = array(
            "tukiniTxt" => "file|max:1000|mimes:txt",
        );
        $this->validate($request, $rules);

        $count = 0;
        if ($request->tukiniTxt) {
            \Log::debug("txtインポート処理開始");

            $tmpName = mt_rand() . "." . $request->tukiniTxt->guessExtension(); //TMPファイル名
            $request->tukiniTxt->move(public_path() . "/importTxt", $tmpName);
            $tmpPath = public_path() . "/importTxt/" . $tmpName;



            /**
             * 必死の努力で導き出した専用正規関数
             * txtデータ→[["date","","","",].......]の配列にする
             * 日付→\d{4}\.\d{1,2}\.\d{1,2}
             * タイトル→\d{4}\.\d{1,2}\.\d{1,2}\s[\u4E00-\u9FFF]{2}\s\d{2}\:\d{2}[\s\S]*?\s-\s
             * 本文→\s-\s[\s\S]*?\d{4}\.\d{1,2}\.\d{1,2}
             */

            $rawTxt = file_get_contents("importTxt/" . $tmpName); //txt読み込み、改行までちゃんとイケてる

            if ($rawTxt) {
                //文章 終わり検知のためのダミーデータ追加
                $rawTxt = $rawTxt . "\n2000.99.99 午前 12:58\n";

                //日付とタイトル
                preg_match_all("@(?<date>\d{4}\.\d{1,2}\.\d{1,2})\s\D+\s\d{2}\:\d{2}\s(?<title>.*)\s\s-\s@", $rawTxt, $extractionResult, PREG_PATTERN_ORDER);
                $dateTxt = $extractionResult['date'];
                $titleTxt = $extractionResult['title'];

                //本文(ここも上のpreg_matchを使いたかったが元のtxtファイルの構造上、終わりが検知できないので、ここでもう一度正規表現)
                preg_match_all("@\s-\s\s(?<content>[\s\S]*?)\d{4}\.\d{1,2}\.\d{1,2}\s\D+\s\d{2}\:\d{2}\s@", $rawTxt, $extractionResult, PREG_PATTERN_ORDER);
                $contentTxt = $extractionResult['content'];


                //各配列をまとめて1つの配列とする

                // 登録処理
                $arrayCounter = 0;
                $today_date = Carbon::now();
                foreach ($dateTxt as $date) {
                    Diary::insert(['updated_at' => $today_date, 'created_at' => $today_date, 'user_id' => Auth::Id(), 'uuid' => Str::uuid(), 'date' => $date, 'title' => $titleTxt[$arrayCounter], 'content' => $contentTxt[$arrayCounter]]);
                    $count++;
                    $arrayCounter++;
                }
            }


            // TMPファイル削除
            if (unlink($tmpPath)) {
                // echo $file.'の削除に成功しました。';
                \Log::debug("$tmpPath.の削除成功");
            } else {
                \Log::debug("$tmpPath.の削除失敗");
            }
            $importResult = $count . "個の日記がインポートされました🎉";
        } else {
            $importResult = "ファイルが見つかりませんでした😢";
        }

        return view("diary/io/afterImport", ["importResult" => $importResult]);
    }
}