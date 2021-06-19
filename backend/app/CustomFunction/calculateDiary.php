<?php

namespace App\CustomFunction;

use Carbon\Carbon;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNan;
use function PHPUnit\Framework\isNull;

class calculateDiary
{
  public static function calculateDiary($diaries)
  {
    $diaryCounter=0;
    $diaryContentCharactersCounter=0;
    $month_words=[];
    $month_diaries=[];
    foreach($diaries as $diary){

        $diaryCharacters=mb_strlen($diary->content);
        // 合計カウント
        $diaryCounter+=1;
        $diaryContentCharactersCounter+=$diaryCharacters;

        // 月ごとカウント
        $diaryDate = Carbon::parse($diary->date);
        $keyName=$diaryDate->year."年".$diaryDate->month."月";
        $month_diaries[$keyName]=isSet( $month_diaries[$keyName])? $month_diaries[$keyName]+1:1;
        $month_words[$keyName]=isSet( $month_words[$keyName])?$month_words[$keyName]+$diaryCharacters:$diaryCharacters;
        
    }
    //配列ソート(普通にやると2019年9月の次が2020年1月になり、2桁目の日付が全部ずれる)
    ksort($month_words,SORT_NATURAL);
    ksort($month_diaries,SORT_NATURAL);
    $result=[
        'total_words'=> $diaryCounter,
        'total_diaries'=>$diaryContentCharactersCounter,
        'month_words'=>$month_words,
        'month_diaries'=>$month_diaries,
    ];
    return $result;
  }
}
