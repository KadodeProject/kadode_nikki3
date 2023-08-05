<?php

declare(strict_types=1);

namespace App\UseCases\Diary;

use App\Models\Diary;
use App\UseCases\Diary\Statistic\ArrangeDiaryStatistic;
use App\UseCases\Diary\Statistic\CheckStatisticStatusByDiary;

/**
 * 配列で渡された複数の日付の日記を取得する
 * グローバルスコープ機能でユーザーIDの絞り込みを事前に行っているため認可制御は適切.
 */
class GetDiariesByArray
{
    public function __construct(
        private CheckStatisticStatusByDiary $checkStatisticStatusByDiary,
        private ArrangeDiaryStatistic $arrangeDiaryStatistic
    ) {
    }

    /**
     * 統計データとともに日記データを返す。
     *
     * @todo Next.jsとblade混在期はResponderでtoJsonまたはtoArrayをするが、それ移行はここで加工しても良いかも？
     *
     * @param array<string> $dates Y-m-dにフォーマットされた文字列(内部で変換するのはループ処理を増やすだけなので、検索できる形で渡してほしい都合)
     *
     * @return array<array>
     */
    public function invoke(array $dates): array
    {
        $diaries = Diary::with(['statisticPerDate', 'diaryProcessed'])->whereIn('date', $dates)->orderby('date', 'desc')->get(['id', 'date', 'title', 'content', 'updated_at']);

        /** ->get()だと必ずcollationが返ってくるので条件分岐不要(0の場合は内部からのcollationが来るのでループ勝手に飛ぶ) */
        $arrangedDiaries = [];
        foreach ($diaries as $diary) {
            $statisticStatus = $this->checkStatisticStatusByDiary->invoke($diary);
            $arrangedDiaries[] = $this->arrangeDiaryStatistic->invoke($diary, $statisticStatus)->toArray();
        }

        return $arrangedDiaries;
    }
}
