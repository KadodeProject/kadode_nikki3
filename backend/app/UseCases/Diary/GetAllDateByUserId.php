<?php

declare(strict_types=1);

namespace App\UseCases\Diary;

use App\Models\Diary;

/**
 * ユーザーが持っている日記の日付の一覧を返す
 * インポートの重複チェックなどで使える
 */
class GetAllDateByUserId
{

    /**
     * 統計データとともに日記データを返す。
     * 日付の重複がないかをクエリを増やさず確認するために日付を取得
     * かぶった場合はマージする必要があるが、ここで本文も取得するとメモリ圧迫するので防ぐ
     * →そもそもインポートは他のサービスからの移行のための需要で成り立つはずなので、重複する可能性は極めて低いと考えられる
     * 配列を連想配列に変えることでisset高速化をできるようにする valueの値が0からの連番になるが、使わないのでそのまま
     * eloquentのtoArrayは[0=>['date']=>2021-01-01,1=>['date']=>2021-01-02]みたいな形で出てくるのでarray_columnで[0=>2021-01-01,1=>2021-01-02]に変換
     * さらにarray_flipで[2021-01-01=>0,2021-01-02=>1]に変換することでissetで判定できるようにする
     * @return array<string,string> issetが使えるように'Y-m-d'をkeyにしており、valueの値は意味を持たない
     */
    public function invoke(int $userId): array
    {
        return array_flip(array_column(Diary::where('user_id', $userId)->get('date')->toArray(), 'date'));
    }
}