<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Controllers\Controller;
use App\UseCases\Diary\GetDiariesByDates;
use App\UseCases\Diary\GetLatestDiaries;
use App\UseCases\Diary\GetSameDayDiariesByDate;
use App\UseCases\Diary\ShapeStatisticFromDiaries;
use App\UseCases\User\GetUnreadNotifications;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

final class ShowHomeAction extends Controller
{
    public function __construct(
        private ShapeStatisticFromDiaries $shapeStatisticFromDiaries,
        private GetLatestDiaries $getLatestDiaries,
        private GetUnreadNotifications $getUnreadNotifications,
        private GetSameDayDiariesByDate $getSameDayDiariesByDate,
        private GetDiariesByDates $getDiariesByDates,
    ) {
    }

    public function __invoke(): View|Factory
    {
        /** 使うもの用意 */
        $user = Auth::user();
        $carbonImmutable = new CarbonImmutable;
        $carbonImmutableToday = $carbonImmutable->today();
        $carbonImmutableYesterday = $carbonImmutable->yesterday();

        /** ホーム画面に出力するお知らせ取得 */
        $unreadNotifications = $this->getUnreadNotifications->invoke($user);

        /**
         * 最新10件を取って、今日と昨日、直近の日記へ振り分ける
         *
         */
        $todayDiary = null;
        $yesterdayDiary = null;
        $latestDiaries = [];
        foreach ($this->getLatestDiaries->invoke() as $latest) {
            if ($carbonImmutableToday->eq($latest['date'])) {
                $todayDiary = $latest;
            } elseif ($carbonImmutableYesterday->eq($latest['date'])) {
                $yesterdayDiary = $latest;
            } else {
                $latestDiaries[] = $latest;
            }
        }


        /** 日付が同じ別の年の日記を取得 */
        $sameDayDiaries = $this->getSameDayDiariesByDate->invoke($carbonImmutableToday);
        /**
         * 先週、先月、2ヶ月前、半年前の日記を取得
         * @todo 変数名要検討
         * @todo 先週、みたいな表記はフロントエンドでやる(Day.jsなど使って)
         */
        $recentDiaries = $this->getDiariesByDates->invoke([
            $carbonImmutableToday->subWeek(1)->format("Y-m-d"),
            $carbonImmutableToday->subMonth(1)->format("Y-m-d"),
            $carbonImmutableToday->subMonth(2)->format("Y-m-d"),
            $carbonImmutableToday->subMonth(6)->format("Y-m-d"),
        ]);
        /** 過去の日記表示配列 +だと一部消えるのでarray_merge */
        $oldDiaries = array_merge($recentDiaries, $sameDayDiaries);
        return view('diary/home', ['unreadNotifications' => $unreadNotifications, 'yesterdayDiary' => $yesterdayDiary, 'todayDiary' => $todayDiary, 'latestDiaries' => $latestDiaries,  'oldDiaries' => $oldDiaries]);
    }
}