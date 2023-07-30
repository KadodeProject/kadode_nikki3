<?php

declare(strict_types=1);

namespace App\UseCases\Diary\Import;

use Carbon\Carbon;
use Str;

/**
 * 重複なしのと重複ありの日記の配列を作る日記.
 */
class CreateDiaryBaseArrayFromImportedData
{
    /**
     * 日付が重複していない日記をまとめて挿入する
     * 厳密には$existdateに代入してからinsertするまでに新しい日記が入る可能性は極めて低いが0ではなく、重複が0件でないことを保証できない
     * テーブルロックとか掛ければよいのだが、天秤にかけたときにそこまでの必要性がないと判断した
     *
     * @param array<array{date:string,title:string,content:string}> $importedData ちゃんとkey=>valueになっていれば重複あっても良い
     * @param array<string,string>                                  $existDates   issetが使えるように'Y-m-d'をkeyにしており、valueの値は意味を持たない
     *
     * @return array{0:array<string,array{updated_at:Carbon,created_at:Carbon,user_id:int,uuid:string,date:Carbon,title:string,content:string}>,1:array<string,array{title:string,content:string}>}
     */
    public function invoke(array $importedData, array $existDates, int $userId): array
    {
        $carbonNow = Carbon::now();

        /** @var array<string,array{title:string,content:string}> deleteする日記を入れる */
        $distinctDiary = [];

        /** @var array<string,array{updated_at:Carbon,created_at:Carbon,user_id:int,uuid:string,date:Carbon,title:string,content:string}> insertする日記を入れる */
        $newDiary = [];

        foreach ($importedData as $data) {
            $date = Carbon::parse($data['date']); // insert時にdateにはcarbonだと都合が良いので
            $dateYmd = $date->format('Y-m-d'); // issetで判定するときはY-m-dと比較することになり、繰り返し呼び出すコストを減らすため
            $title = $data['title'];
            $content = $data['content'];
            // in_array($date,$existDates)でもできるが、処理が遅いので高速なissetを活用する
            // この時点で日付の形式がY-m-dである必要がある
            if (isset($existDates[$dateYmd])) {
                // 存在する→重複が起きるのでupdate側に
                // さらにインポートしたデータ内でも同一の日付を含む可能性があるので、同一だったらマージするようにする
                if (isset($distinctDiary[$dateYmd])) {
                    // あったら改行＋タイトル＋改行＋本文を元の本文に追加する
                    $distinctDiary[$dateYmd]['content'] .= "\n\n\n".$title."\n\n".$content;
                } else {
                    $distinctDiary[$dateYmd] = ['title' => $title, 'content' => $content];
                }
            } else {
                // さらにインポートしたデータ内でも同一の日付を含む可能性があるので、同一だったらマージするようにする
                if (isset($newDiary[$dateYmd])) {
                    // あったら改行＋タイトル＋改行＋本文を元の本文に追加する
                    $newDiary[$dateYmd]['content'] .= "\n\n\n".$title."\n\n".$content;
                } else {
                    $newDiary[$dateYmd] = ['updated_at' => $carbonNow, 'created_at' => $carbonNow, 'user_id' => $userId, 'uuid' => Str::uuid(), 'date' => $date, 'title' => $title, 'content' => $content];
                }
            }
        }

        return [$newDiary, $distinctDiary];
    }
}
