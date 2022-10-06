<?php

declare(strict_types=1);

namespace App\UseCases\Diary;

use App\Models\Diary;

/**
 * 日記をuuidから取得する
 * グローバルスコープ機能でユーザーIDの絞り込みを事前に行っているため認可制御は適切
 *
 */
class GetDiariesByDate
{
    /**
     * 統計データとともに日記データを返す。
     * 戻り値は必ず配列
     * @return array<{form:string,xPOSTag:string,color:string}> | array<>
     */
    public function invoke(string $date): array
    {
        $diary = Diary::join('statistic_per_dates', 'diaries.id', 'statistic_per_dates.diary_id')->where("date", "<", $date);

        /**
         * laravelのお作法的には下だが、今回はN+1問題関係なく全部の日記で統計データ使うのでこれは使わない
         * この書き方だと階層が深くなるため
         */
        //$diary = Diary::with('StatisticPerDate')->where("uuid", $uuid)->first()->toArray();
        if ($diary instanceof Diary) {
            /**
             * $diaryに代入している時点でtoArrayをすると日記存在しない時にエラーになるため、条件分岐で絞った後にtoArray
             * 若干冗長だが、確実に配列を返したいので……
             */
            return $diary->toArray();
        } else {
            return [];
        }
    }
}