<?php

declare(strict_types=1);

namespace App\UseCases\Diary\Import;

use App\Models\Diary;

/**
 * DBに存在する日記と日付の被った日記をうまい具合にマージする.
 */
class UpsertDiaryFromImportData
{
    /**
     * DBに存在する日記と日付の被った日記をうまい具合にマージする
     * upsertを用いるためinsertをここですることももちろんできるが、無駄にuuidを発行するなどコストが増えるため行わない.
     *
     * @param array<string,array{title:string,content:string}> $distinctDiary 重複のある日記とデータ keyにはY-m-dで日付が入る
     */
    public function invoke(array $distinctDiary, int $userId): void
    {
        /** @var array<string,array{id:int,content:string}> DBに既に存在する日付の日記の内容を取得して 'Y-m-d'=>[id,内容]の配列を作る */
        $existDateContents = [];
        // 合体するために内容を取得する array_columnでの実装は廃止(右辺に配列を作れないため)
        foreach (Diary::whereIn('date', array_keys($distinctDiary))->get(['date', 'content', 'id', 'uuid'])->toArray() as $diary) {
            $existDateContents[$diary['date']] = [
                'id'      => $diary['id'],
                'uuid'    => $diary['uuid'],
                'content' => $diary['content'],
            ];
        }
        // 合体しながらupdateする(upsertでinsertは想定しておらず、あくまでループでupdateをしないために用いている),発行されるsqlはinsert on dupliucate keyみたいな感じなので結局uuidとかも必要
        Diary::upsert(
            array_map(function ($diary, $date) use ($userId, $existDateContents) {
                $diary['id'] = $existDateContents[$date]['id'];
                $diary['user_id'] = $userId;
                $diary['date'] = $date;
                $diary['uuid'] = $existDateContents[$date]['uuid'];
                $diary['content'] = $existDateContents[$date]['content']."\n\n\n".$diary['title']."\n\n".$diary['content'];

                return $diary;
            }, $distinctDiary, array_keys($distinctDiary)),
            ['id'],
            ['content']
        );
    }
}
