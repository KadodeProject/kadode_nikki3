<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary\Export;

use App\Models\Diary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;

class ExportByCsvUtf8Action
{
    public function __invoke(): Redirector|RedirectResponse
    {
        $diaries = Diary::orderby('date', 'asc')->select(['date', 'title', 'content'])->get()->toArray();
        // \Log::debug("message".$diary);
        // CSVカラムの生成
        $head = ['日付', 'タイトル', '内容'];

        // 書き込み用ファイルを開く
        $uuid = Str::uuid();
        $f = fopen("exportCsv/{$uuid}.csv", 'w');
        if ($f) {
            fputcsv($f, $head);
            // データの書き込み
            foreach ($diaries as $diary) {
                fputcsv($f, $diary);
            }
        }
        // ファイルを閉じる
        fclose($f);
        // HTTPヘッダ
        // @todo ここにheaderは責務分割的によろしくない
        header('Content-Type: application/octet-stream');
        header('Content-Length: '.filesize("exportCsv/{$uuid}.csv"));
        header("Content-Disposition: attachment; filename=exportCsv/{$uuid}.csv");
        readfile("exportCsv/{$uuid}.csv");

        $file = "exportCsv/{$uuid}.csv";
        unlink($file);

        return redirect(route('ShowSetting'));
    }
}
