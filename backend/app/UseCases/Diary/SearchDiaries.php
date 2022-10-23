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
class SearchDiaries
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
     * @return array<array>
     */
    public function invoke(string $searchWords): array
    {
        $diaries = Diary::with('statisticPerDate')->where('content', 'like', "%{$searchWords}%")->orderby('date', 'desc')->take(200)->get();

        /** ->get()だと必ずcollationが返ってくるので条件分岐不要(0の場合は内部からのcollationが来るのでループ勝手に飛ぶ) */
        $arrangedDiaries = [];
        foreach ($diaries as $diary) {
            /**
             * 日記文字ハイライト処理.
             */
            // キーワードの長さ
            $keywordLength = mb_strlen($searchWords);
            // 日記の長さ
            $searchWordsLength = mb_strlen($diary->content);
            // キーワードまでの文字数
            $placeOfWord = mb_strpos($diary->content, $searchWords);

            // キーワードまでの文字数-100がマイナスなら0にする
            $placeStart = ($placeOfWord - 100 >= 0) ? ($placeOfWord - 100) : 0;
            // 検索したキーワード含めずに後ろ100字 日記の文字数オーバーしない範囲で
            $placeEnd = ($placeOfWord + $keywordLength + 100 <= $searchWordsLength) ? ($placeOfWord + $keywordLength + 100) : $searchWordsLength;

            // 前後100字含めた切り出し
            $diary->content = mb_substr($diary->content, $placeStart, $placeEnd - $placeStart);

            // キーワードハイライトのための代入
            // キーワードの長さ
            $keywordLength = mb_strlen($searchWords);
            // 日記の長さ
            $searchWordsLength = mb_strlen($diary->content);
            // キーワードまでの文字数
            $placeOfWord = mb_strpos($diary->content, $searchWords);
            /*
             * これはgeneraol_ci時代の対策
             * ここcollation対策(ハハパパでDB側ではSELECTされてるのにmb_strposでは引っかかった結果壊れるみたいなことがある)
             * 見つからない時mb_strposがfalseを返すのでそれを利用
             */
            if (false !== $placeOfWord) {
                // ハイライト追加に際して、シーケンスせずhtml解釈させるので、その前に攻撃防止のためにタグを防ぐ
                $diary->content = htmlspecialchars($diary->content, ENT_QUOTES);
                // ハイライト追加
                // webpackでビルドに変更したため、ここでTailwindのCSS指定しても生成されないため、styleで指定
                $diary->content = mb_substr($diary->content, 0, $placeOfWord)."<span style='background-color:#FFFDBF;color:var(--kn_b)'>".mb_substr($diary->content, $placeOfWord, $keywordLength).'</span>'.mb_substr($diary->content, $placeOfWord + $keywordLength);
            }

            $statisticStatus = $this->checkStatisticStatusByDiary->invoke($diary);
            $arrangedDiaries[] = $this->arrangeDiaryStatistic->invoke($diary, $statisticStatus)->toArray();
        }

        return $arrangedDiaries;
    }
}
