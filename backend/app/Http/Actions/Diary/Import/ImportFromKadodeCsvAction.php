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
use function count;

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

            //文字コードをUTF-8に変換、CSVのヘッダー行を無視
            $config->setToCharset("UTF-8");
            $config->setFromCharset("sjis-win");
            $config->setIgnoreHeaderLine(true);

            $carbonNow = Carbon::now();
            $userId = Auth::id();
            /**
             */

            //
            /**
             *
             * 日付の重複がないかをクエリを増やさず確認するために日付を取得
             * かぶった場合はマージする必要があるが、ここで本文も取得するとメモリ圧迫するので防ぐ
             * →そもそもインポートは他のサービスからの移行のための需要で成り立つはずなので、重複する可能性は極めて低いと考えられる
             * 配列を連想配列に変えることでisset高速化をできるようにする valueの値が0からの連番になるが、使わないのでそのまま
             * eloquentのtoArrayは[0=>['date']=>2021-01-01,1=>['date']=>2021-01-02]みたいな形で出てくるのでarray_columnで[0=>2021-01-01,1=>2021-01-02]に変換
             * さらにarray_flipで[2021-01-01=>0,2021-01-02=>1]に変換することでissetで判定できるようにする
             */
            $existDates = array_flip(array_column(Diary::where('user_id', $userId)->get('date')->toArray(), 'date'));

            /** @var array<string,{title:string,content:string}> deleteする日記を入れる */
            $distinctDiary = [];
            /** @var array<string,{updated_at:Carbon,created_at:Carbon,user_id:int,uuid:string,date:Carbon,title:string,content:string}> insertする日記を入れる */
            $newDiary = [];
            $interpreter->addObserver(function (array $row) use (&$existDates, &$newDiary, &$distinctDiary, $carbonNow, $userId) {
                $date = Carbon::parse($row[0]); //insert時にdateにはcarbonだと都合が良いので
                $dateYmd = $date->format('Y-m-d'); //issetで判定するときはY-m-dと比較することになり、繰り返し呼び出すコストを減らすため
                $title = $row[1];
                $content = $row[2];
                //in_array($date,$existDates)でもできるが、処理が遅いので高速なissetを活用する
                //この時点で日付の形式がY-m-dである必要がある
                if (isset($existDates[$dateYmd])) {
                    //存在する→重複が起きるのでupdate側に
                    //さらにインポートしたデータ内でも同一の日付を含む可能性があるので、同一だったらマージするようにする
                    if (isset($distinctDiary[$dateYmd])) {
                        //あったら改行＋タイトル＋改行＋本文を元の本文に追加する
                        $distinctDiary[$dateYmd]['content'] .= "\n\n\n" . $title . "\n\n" . $content;
                    } else {
                        $distinctDiary[$dateYmd] = ['title' => $title, 'content' => $content];
                    }
                } else {
                    //さらにインポートしたデータ内でも同一の日付を含む可能性があるので、同一だったらマージするようにする
                    if (isset($newDiary[$dateYmd])) {
                        //あったら改行＋タイトル＋改行＋本文を元の本文に追加する
                        $newDiary[$dateYmd]['content'] .= "\n\n\n" . $title . "\n\n" . $content;
                    } else {
                        $newDiary[$dateYmd] = ['updated_at' => $carbonNow, 'created_at' => $carbonNow, 'user_id' => $userId, 'uuid' => Str::uuid(), 'date' => $date, 'title' => $title, 'content' => $content];
                    }
                }
            });

            /** CSVファイル削除処理 */
            // CSVデータをパース
            $lexer->parse($tmpPath, $interpreter);
            // TMPファイル削除
            if (unlink($tmpPath)) {
                // echo $file.'の削除に成功しました。';
                Log::debug("$tmpPath.の削除成功");
            } else {
                Log::debug("$tmpPath.の削除失敗");
            }

            //$newDiary[] = ['updated_at' => $carbonNow, 'created_at' => $carbonNow, 'user_id' => $userId, 'uuid' => Str::uuid(), 'date' => Carbon::parse($date)->toDateString(), 'title' => $title, 'content' => $content];

            /**
             * 日付重複しない日記挿入
             * 厳密には$existdateに代入してからinsertするまでに新しい日記が入る可能性は極めて低いが0ではなく、重複が0件でないことを保証できない
             * テーブルロックとか掛ければよいのだが、天秤にかけたときにそこまでの必要性がないと判断した
             */
            Diary::insert(array_values($newDiary));

            /**
             * 日付重複する日記挿入
             */

            /** @var array<string,{id:int,content:string}> DBに既に存在する日付の日記の内容を取得して 'Y-m-d'=>[id,内容]の配列を作る */
            $existDateContents = [];
            //合体するために内容を取得する array_columnでの実装は廃止(右辺に配列を作れないため)
            foreach (Diary::whereIn('date', array_keys($distinctDiary))->get(['date', 'content', 'id', 'uuid'])->toArray() as $diary) {
                $existDateContents[$diary['date']] = [
                    'id' => $diary['id'],
                    'uuid' => $diary['uuid'],
                    'content' => $diary['content'],
                ];
            }
            //合体しながらupdateする(upsertでinsertは想定しておらず、あくまでループでupdateをしないために用いている),発行されるsqlはinsert on dupliucate keyみたいな感じなので結局uuidとかも必要
            Diary::upsert(
                array_map(function ($diary, $date) use ($userId, $existDateContents) {
                    $diary['id'] = $existDateContents[$date]['id'];
                    $diary['user_id'] = $userId;
                    $diary['date'] = $date;
                    $diary['uuid'] = $existDateContents[$date]['uuid'];
                    $diary['content'] = $existDateContents[$date]['content'] . "\n\n\n" . $diary['title'] . "\n\n" . $diary['content'];
                    return $diary;
                }, $distinctDiary, array_keys($distinctDiary)),
                ['id'],
                ['content']
            );


            $importResult = count($newDiary) . "つの日記が新規でインポートされ、" . count($distinctDiary) . "の日記がアップデートされました🎉";
        } else {
            $importResult = "ファイルが見つかりませんでした😢";
        }

        return view("diary/io/afterImport", ["importResult" => $importResult]);
    }
}