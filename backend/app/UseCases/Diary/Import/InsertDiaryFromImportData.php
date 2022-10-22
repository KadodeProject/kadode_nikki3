<?php

declare(strict_types=1);

namespace App\UseCases\Diary\Import;

use App\Models\Diary;

/**
 * 日付が重複していない日記をまとめて挿入する.
 */
class InsertDiaryFromImportData
{
    /**
     * 日付が重複していない日記をまとめて挿入する
     * 厳密には$existdateに代入してからinsertするまでに新しい日記が入る可能性は極めて低いが0ではなく、重複が0件でないことを保証できない
     * テーブルロックとか掛ければよいのだが、天秤にかけたときにそこまでの必要性がないと判断した
     *
     * @param array<string,{updated_at:Carbon,created_at:Carbon,user_id:int,uuid:string,date:Carbon,title:string,content:string}> $newDiary insertする日記(重複ないことを確認済みで整形済みのもの)
     */
    public function invoke(array $newDiary): void
    {
        Diary::insert(array_values($newDiary));
    }
}
