<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary\Import;

use App\Http\Controllers\Controller;
use App\UseCases\Diary\GetAllDateByUserId;
use App\UseCases\Diary\Import\CreateDiaryBaseArrayFromImportedData;
use App\UseCases\Diary\Import\InsertDiaryFromImportData;
use App\UseCases\Diary\Import\UpsertDiaryFromImportData;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @todo ここDRYにめちゃくちゃ反してるのでインターフェイス作って抽象化したい
 */
class ImportFromKadodeCsvAction extends Controller
{
    public function __construct(
        private GetAllDateByUserId $getAllDateByUserId,
        private UpsertDiaryFromImportData $upsertDiaryFromImportData,
        private InsertDiaryFromImportData $insertDiaryFromImportData,
        private CreateDiaryBaseArrayFromImportedData $createDiaryBaseArrayFromImportedData,
    ) {
    }

    public function __invoke(Request $request): View|Factory
    {
        // バリデーション、CSV形式、1M以内のファイル
        // csvだけだと何故かエラー出るので、やむをえず、txtも。 .csv認識できてないっぽい
        $rules = [
            'kadodeCsv' => 'file|max:2000|mimes:csv,txt',
        ];
        $this->validate($request, $rules);

        // CSV ファイル保存
        if ($request->kadodeCsv) {
            $userId = Auth::id();
            $tmpName = mt_rand().'.'.$request->kadodeCsv->guessExtension(); // TMPファイル名
            $request->kadodeCsv->move(public_path().'/importCsv', $tmpName);
            $tmpPath = public_path().'/importCsv/'.$tmpName;

            // Goodby CSVのconfig設定
            $config = new LexerConfig();
            $interpreter = new Interpreter();
            $lexer = new Lexer($config);

            // 文字コードをUTF-8に変換、CSVのヘッダー行を無視
            $config->setToCharset('UTF-8');
            $config->setFromCharset('UTF-8');
            $config->setIgnoreHeaderLine(true);

            /** @var array<array{date:string,title:string,content:string}> */
            $importDataProceed = [];

            // CSVのからデータを取得してuescaseに投げられる形に変換
            $interpreter->addObserver(function (array $row) use (&$importDataProceed): void {
                $importDataProceed[] = [
                    'date' => $row[0],
                    'title' => $row[1],
                    'content' => $row[2],
                ];
            });

            // CSVデータをパース($interpreterでaddObserverした後にparseをすることで値が中に入るため、addObserverの処理はここで実行される)
            $lexer->parse($tmpPath, $interpreter);
            // CSVファイル削除処理
            unlink($tmpPath) ?? exit('ファイル削除に失敗しました');

            // issetで日付の存在判定するための日付の配列が帰ってくる 'Y-m-d'=>無意味の値 みたいな形
            $existDates = $this->getAllDateByUserId->invoke($userId);

            [$newDiary, $distinctDiary] = $this->createDiaryBaseArrayFromImportedData->invoke($importDataProceed, $existDates, $userId);

            // インポートしたデータから重複チェックを行いDB上の日付被っている日記と被っていない日記に振り分ける
            // 重複してない日付の日記をDBへ
            $this->insertDiaryFromImportData->invoke($newDiary);
            // 重複した日付の日記をDBへ
            $this->upsertDiaryFromImportData->invoke($distinctDiary, $userId);

            $importResult = \count($newDiary).'つの日記が新しくインポートされ、'.\count($distinctDiary).'の日記がアップデートされました🎉';
        } else {
            $importResult = 'ファイルが見つかりませんでした😢';
        }

        return view('diary/io/afterImport', ['importResult' => $importResult]);
    }
}
