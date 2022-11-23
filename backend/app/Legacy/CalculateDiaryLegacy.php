<?php

declare(strict_types=1);

/**
 * これは現在使っていない関数
 * 統計情報をPHP側で処理していた時代の遺構(日記の文字数推移や執筆率で使用していた).
 */

namespace App\CustomFunction;

use Illuminate\Support\Carbon;

class CalculateDiaryLegacy
{
    public static function calculateDiary($diaries)
    {
        $diaryCounter = 0;
        $diaryContentCharactersCounter = 0;
        $month_words = [];
        $month_diaries = [];
        foreach ($diaries as $diary) {
            $diaryCharacters = mb_strlen($diary->content);
            // 合計カウント
            $diaryCounter++;
            $diaryContentCharactersCounter += $diaryCharacters;

            // 月ごとカウント
            $diaryDate = Carbon::parse($diary->date);

            // /こうするしかなかった…　本当は2020年12月みたいにしたかったけれど、sort関数邪道にもできず、数値で諦めた。
            $keyName = $diaryDate->year.($diaryDate->month >= 10 ? $diaryDate->month : '0'.$diaryDate->month);
            $month_diaries[$keyName] = isset($month_diaries[$keyName]) ? $month_diaries[$keyName] + 1 : 1;
            $month_words[$keyName] = isset($month_words[$keyName]) ? $month_words[$keyName] + $diaryCharacters : $diaryCharacters;
        }
        // 配列ソート(普通にやると2019年9月の次が2020年1月になり、2桁目の日付が全部ずれる)
        // →どう頑張っても正しくソートされないので諦め
        // ksort($month_words,SORT_LOCALE_STRING   );
        // ksort($month_diaries,SORT_LOCALE_STRING   );
        return [
            'total_words' => $diaryContentCharactersCounter,
            'total_diaries' => $diaryCounter,
            'month_words' => $month_words,
            'month_diaries' => $month_diaries,
        ];
    }
}
