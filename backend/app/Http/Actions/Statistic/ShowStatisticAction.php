<?php

declare(strict_types=1);

namespace App\Http\Actions\Statistic;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\UseCases\Statistic\GetStatistic;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShowStatisticAction extends Controller
{
    public function __construct(
        private GetStatistic $getStatistic,
    ) {
    }

    /**
     * @todo ここ地獄すぎるのでUseCaseに分離したい
     * リニューアルで消える部分なのである程度は放置
     */
    public function __invoke(): View|Factory
    {
        $userId = Auth::id();
        $statistic = $this->getStatistic->invoke($userId);

        /**
         * 日記数少なすぎるときは警告出したいので
         * これは統計表示前にも使うので1統計テーブルからのデータは使えない.
         */
        $number_of_nikki = Diary::count();
        $wordCloud_array = [];

        $ended_diaries_count = ''; // undefinedエラー防止用
        $char_length_frequency_distribution = []; // undefinedエラー防止用
        $biggerDiaries = []; // undefinedエラー防止用
        $anime_timeline = []; // undefinedエラー防止用
        $oldest_diary_date = '';
        // 統計作っていない場合はEnum型取れずnullになるので
        if (null !== $statistic) {
            if (1 === $statistic->statisticStatus->value) {
                /**
                 * 名詞と形容詞の登場順.
                 */

                // 一度変数に代入しないと怒られるのでこうしている。
                $statistic_month_diaries = $statistic->month_diaries; // 平均文字数で利用

                /**
                 * 月当たりの平均文字数にする(月の合計文字数わる日記数).
                 */
                $tmp = [];
                $i = 0;
                foreach ($statistic->month_words as $month_word) {
                    $tmp[] = $month_word / $statistic_month_diaries[$i];
                    ++$i;
                }
                $statistic->month_words_per_diary = $tmp;

                /**
                 * 月ごとの執筆率.
                 */
                $monthWritingRate = [];
                $i = 0;
                foreach ($statistic->months as $date) {
                    // 閏年などの対応のため、毎度月の長さをcarbonで作る
                    // mbの必要ないので。ただのsubstr 202101みたいな形式なっているので。
                    $year = mb_substr($date, 0, 3);
                    $month = mb_substr($date, 5);
                    $start = Carbon::create($year, $month);
                    $end = Carbon::create($year, $month)->endOfMonth();

                    // 月の長さ↓
                    $lengthThisMonth = $start->diffInDays($end) + 1;

                    // 執筆率の計算
                    $writingRate = ($statistic_month_diaries[$i] / $lengthThisMonth) * 100;

                    $monthWritingRate[] = $writingRate;
                    ++$i;
                }
                $statistic->monthWritingRate = $monthWritingRate;

                // wordCloud描画用
                /*必要なデータ形式
                 * [
                {"word":"あああ","count":9},
                {"word":"いいい","count":3},
                {"word":"ううう","count":4},
                {"word":"えええ","count":3},]
                 */
                foreach ($statistic->important_words as $value) {
                    $wordCloud_array[] = ['word' => $value[0], 'count' => $value[1]];
                }

                /**
                 * ヒストグラム用のやつ.
                 */
                $char_length_obj = DB::table('diaries')
                    ->where('diaries.user_id', $userId)
                    ->leftJoin('diary_processeds', 'diaries.id', '=', 'diary_processeds.diary_id')
                    ->select('diary_processeds.char_length')
                    ->get();

                // array_valuesだと何故か事故るので
                // 文字数の配列取得
                $char_length_list = [];
                foreach ($char_length_obj as $value) {
                    $char_length_list[] = $value->char_length;
                }
                // からの要素削除(nullがあるとmin()で盛大に壊れる))
                $char_length_list = array_filter($char_length_list);

                /**
                 * 度数分布表の作成.
                 */
                $char_length_frequency_distribution = []; // 配列の1つ目に度数、2つ目に度数の値
                $frequencies = []; // 度数の最小値を入れる
                $max = max($char_length_list);
                $min = min($char_length_list);

                $width = ceil(($max - $min) / 20); // 20分割、切り上げ,20個生成するので、どう転んでも入り切るように切り上げ
                $i = $min;
                for ($n = 1; $n <= 20; ++$n) {
                    $char_length_frequency_distribution[$i.'-'.($i + $width)] = 0; // 707-708みたいな感じ xx以上-xx未満
                    $frequencies[] = $i;
                    $i += $width;
                }
                // 度数分布表への代入
                foreach ($char_length_list as $value) {
                    foreach (array_reverse($frequencies) as $frequency) {
                        if ($value >= $frequency) {
                            ++$char_length_frequency_distribution[$frequency.'-'.($frequency + $width)];
                            // \Log::debug($value."は".($frequency)."-".($frequency+$width)."に入る");
                            break;
                        }
                    }
                }

                // 文字数多いのトップ10
                $biggerDiaries = DB::table('diaries')
                    ->where('diaries.user_id', $userId)
                    ->leftJoin('diary_processeds', 'diaries.id', '=', 'diary_processeds.diary_id')
                    ->orderBy('diary_processeds.char_length', 'desc')
                    ->select('diaries.date', 'diaries.title', 'diaries.uuid', 'diary_processeds.char_length')
                    ->limit(10)
                    ->get();

                /**
                 * アニメのタイムライン描画.
                 */
                // id content start(end)
                $anime_data = DB::table('diaries')
                    ->where('diaries.user_id', $userId)
                    ->whereNotNull('diary_processeds.affiliation')
                    ->leftJoin('diary_processeds', 'diaries.id', '=', 'diary_processeds.diary_id')
                    ->select('diaries.date', 'diary_processeds.affiliation')
                    ->get();
                $i = 0;
                // アニメ名と日付を取得
                foreach ($anime_data as $value) {
                    $affiliation = json_decode($value->affiliation, true);
                    foreach ($affiliation as $words) {
                        if ('Animation' === $words['form']) {
                            ++$i;
                            $anime_timeline[] = [$i, $words['lemma'], $value->date];
                        }
                    }
                }
            } elseif (3 === $statistic->statisticStatus->value) {
                /**
                 * 個別日記処理の進捗を取得する処理.
                 */
                $ended_diaries_count = DB::table('diaries')
                    ->where('diaries.user_id', $userId)
                    ->whereNotNull('diary_processeds.affiliation')
                    ->leftJoin('diary_processeds', 'diaries.id', '=', 'diary_processeds.diary_id')
                    ->sum('diary_processeds.statistic_progress') / 100;
            }
            // 最古の日記
            $oldest_diary = Diary::orderBy('date', 'asc')->first(['date']);
            $oldest_diary_date = $oldest_diary->date;
        }

        return view('diary/statistics/topStatistics', ['statistics' => $statistic, 'anime_timeline' => $anime_timeline, 'char_length_frequency_distribution' => $char_length_frequency_distribution, 'biggerDiaries' => $biggerDiaries, 'oldest_diary_date' => $oldest_diary_date, 'number_of_nikki' => $number_of_nikki, 'ended_diaries_count' => $ended_diaries_count, 'wordCloud_array' => $wordCloud_array]);
    }
}
