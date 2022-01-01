<?php

/**
 * これは現在使っていない関数
 * 統計情報をPHP側で処理していた時代の遺構(日記の文字数推移や執筆率で使用していた)
 */
namespace App\CustomFunction;

use Illuminate\Support\Carbon;

class diaryDisplayPreProcessing
{
    /**
     * アーカイブなどで日記の統計情報を表示するための前処理
     * 最新かの判定、jsonの変換など
     *
     * @param [type] $diaries
     * @return void
     */
    public static function shapeStatisticFromDiaries($diaries){
    /**
     * 該当日記の統計データの表示処理
     */
    $i=0;
    foreach ($diaries as $diary) {
        $diaries[$i]->is_latest_statistic=false;
        //統計データがあり、その統計データが日記の内容と合致しているかの判断
        if(isset($diaries[$i]->updated_statistic_at)){
            $diary_update= new Carbon($diaries[$i]->updated_at);
            $stati_update=new Carbon($diaries[$i]->updated_statistic_at);
            //gtでgreater than 日付比較
            if($diaries[$i]->statistic_progress==100 && $stati_update->gt($diary_update)){
                $diaries[$i]->is_latest_statistic=true;
                $diaries[$i]->important_words=array_values(json_decode($diary->important_words,true));
                $diaries[$i]->special_people=array_values(json_decode($diary->special_people,true));
            }
        }
        $i+=1;
    }
    //統計データの表示処理ここまで

    return $diaries;
    }
}