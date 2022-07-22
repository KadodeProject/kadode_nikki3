<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary\Import;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Diary;
/**
 * @todo ここDRYにめちゃくちゃ反してるのでインターフェイス作って抽象化したい
 */
class ImportFromTukiniTxtAction extends Controller
{
    public function __invoke(Request $request): View|Factory
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
            $importResult = $count . "つの日記がインポートされました🎉";
        } else {
            $importResult = "ファイルが見つかりませんでした😢";
        }

        return view("diary/io/afterImport", ["importResult" => $importResult]);
    }
}
