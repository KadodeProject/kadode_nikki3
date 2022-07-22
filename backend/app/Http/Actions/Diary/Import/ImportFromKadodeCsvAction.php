<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary\Import;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Log;

/**
 * @todo ここDRYにめちゃくちゃ反してるのでインターフェイス作って抽象化したい
 */
class ImportFromKadodeCsvAction extends Controller
{
    public function __invoke(Request $request): View|Factory
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
            Log::debug("csvインポート処理開始");

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
                Log::debug("$tmpPath.の削除成功");
            } else {
                Log::debug("$tmpPath.の削除失敗");
            }
            $today_date = Carbon::now();
            // 登録処理
            foreach ($dataList as $row) {
                Diary::insert(['updated_at' => $today_date, 'created_at' => $today_date, 'user_id' => Auth::Id(), 'uuid' => Str::uuid(), 'date' => Carbon::parse($row[0])->toDateString(), 'title' => $row[1], 'content' => $row[2]]);
                $count++;
            }
            $importResult = $count . "つの日記がインポートされました🎉";
        } else {
            $importResult = "ファイルが見つかりませんでした😢";
        }

        return view("diary/io/afterImport", ["importResult" => $importResult]);
    }
}
