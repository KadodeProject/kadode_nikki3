<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary\Import;

use App\Http\Controllers\Controller;
use App\UseCases\Diary\GetAllDateByUserId;
use App\UseCases\Diary\Import\CreateDiaryBaseArrayFromImportedData;
use App\UseCases\Diary\Import\InsertDiaryFromImportData;
use App\UseCases\Diary\Import\UpsertDiaryFromImportData;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

/**
 * @todo ここDRYにめちゃくちゃ反してるのでインターフェイス作って抽象化したい
 */
class ImportFromTukiniTxtAction extends Controller
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
        // $request->tukiniTxt;
        // バリデーション、txt形式、1M以内のファイル
        $rules = [
            'tukiniTxt' => 'file|max:1000|mimes:txt',
        ];
        $this->validate($request, $rules);

        if ($request->tukiniTxt) {
            Log::debug('txtインポート処理開始');

            $tmpName = mt_rand().'.'.$request->tukiniTxt->guessExtension(); // TMPファイル名
            $request->tukiniTxt->move(public_path().'/importTxt', $tmpName);
            $tmpPath = public_path().'/importTxt/'.$tmpName;

            /** @var int */
            $arrayCounter = 0;

            /** @var int */
            $userId = Auth::id();

            /** @var array<array{date:string,title:string,content:string}> */
            $importDataProceed = [];

            $rawTxt = file_get_contents('importTxt/'.$tmpName); // txt読み込み、改行までちゃんとイケてる
            if ($rawTxt) {
                // 文章 終わり検知のためのダミーデータ追加
                $rawTxt = $rawTxt."\n2000.99.99 午前 12:58\n";

                /*
                 * txtデータ→[["date","","","",].......]の配列にする
                 * 日付→\d{4}\.\d{1,2}\.\d{1,2}
                 * タイトル→\d{4}\.\d{1,2}\.\d{1,2}\s[\u4E00-\u9FFF]{2}\s\d{2}\:\d{2}[\s\S]*?\s-\s
                 * 本文→\s-\s[\s\S]*?\d{4}\.\d{1,2}\.\d{1,2}
                 */
                // 日付とタイトル
                preg_match_all('@(?<date>\\d{4}\\.\\d{1,2}\\.\\d{1,2})\\s\\D+\\s\\d{2}\\:\\d{2}\\s(?<title>.*)\\s\\s-\\s@', $rawTxt, $extractionResult, PREG_PATTERN_ORDER);
                $dateTxt = $extractionResult['date'];
                $titleTxt = $extractionResult['title'];

                // 本文(ここも上のpreg_matchを使いたかったが元のtxtファイルの構造上、終わりが検知できないので、ここでもう一度正規表現)
                preg_match_all('@\\s-\\s\\s(?<content>[\\s\\S]*?)\\d{4}\\.\\d{1,2}\\.\\d{1,2}\\s\\D+\\s\\d{2}\\:\\d{2}\\s@', $rawTxt, $extractionResult, PREG_PATTERN_ORDER);
                $contentTxt = $extractionResult['content'];

                // useCasesで使える形にインポート
                foreach ($dateTxt as $date) {
                    $importDataProceed[] = [
                        'date' => str_replace('.', '-', $date),
                        'title' => $titleTxt[$arrayCounter],
                        'content' => $contentTxt[$arrayCounter],
                    ];
                    $arrayCounter++;
                }
            }

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
