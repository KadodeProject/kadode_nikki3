<?php

declare(strict_types=1);

namespace App\UseCases\Diary;

use App\Models\Diary;
use Carbon\CarbonImmutable;

/**
 * 指定した日記idの前後の日付とその日記の存在チェックとuuidを取得する.
 */
class GetDiariesDateNextToDiaryById
{
    /**
     * @return array{next:array{date:DateTime,uuid:string},former:array{date:DateTime,uuid:string}}
     *
     * @todo ここは1日記1日付が成り立つ前提で作られている
     */
    public function invoke(string $date): array
    {
        $carbonInstance = new CarbonImmutable($date);
        $yesterday = $carbonInstance->addDay();
        $tomorrow = $carbonInstance->subDay();

        // 日付大きい順に2つinで取ることでクエリ数を削減
        $bothDiaries = Diary::whereIn('date', [$yesterday->format('Y-m-d'), $tomorrow->format('Y-m-d')])->orderBy('date', 'desc')->limit(2)->get(['date', 'uuid'])->toArray();
        /*
         * パターン
         * 日記0,日記1(前日のみ、翌日のみ),日記2
         */
        $next_uuid = '';
        $former_uuid = '';

        foreach ($bothDiaries as $diary) {
            if ($diary['date'] === $tomorrow) {
                $next_uuid = $diary['uuid'];
            } elseif ($diary['date'] === $yesterday) {
                $former_uuid = $diary['uuid'];
            }
        }

        // @todo uuid廃止してdateだけでURL生成するようにしたいので後ほどこの配列もuuidからidに変えたい
        return [
            'next' => [
                'date' => $tomorrow->toDateTime(),
                'uuid' => $next_uuid,
            ],
            'former' => [
                'date' => $yesterday->toDateTime(),
                'uuid' => $former_uuid,
            ],
        ];
    }
}
