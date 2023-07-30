<?php

declare(strict_types=1);

namespace App\Http\ApiActions;

use App\Http\Controllers\Controller;
use App\UseCases\Diary\GetDiariesByArray;
use App\UseCases\Diary\GetLatestDiaries;
use App\UseCases\Diary\GetSameDayDiariesByDate;
use App\UseCases\User\GetUnreadNotifications;
use Carbon\CarbonImmutable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class GetHomeAction extends Controller
{
    public function __construct(
        private GetLatestDiaries $getLatestDiaries,
        private GetUnreadNotifications $getUnreadNotifications,
        private GetSameDayDiariesByDate $getSameDayDiariesByDate,
        private GetDiariesByArray $getDiariesByArray,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        /** 使うもの用意 */
        $user = Auth::user();

        if ($user === null) {
            // 認証されていない場合の処理
            throw new AuthenticationException();
        }
        $carbonImmutable = new CarbonImmutable();
        $carbonImmutableToday = $carbonImmutable->today();
        $zeroDayYmd = $carbonImmutableToday->format('Y-m-d');
        $oneDayYmd = $carbonImmutableToday->subDays(1)->format('Y-m-d');
        $twoDayYmd = $carbonImmutableToday->subDays(2)->format('Y-m-d');
        $threeDayYmd = $carbonImmutableToday->subDays(3)->format('Y-m-d');

        /** ホーム画面に出力するお知らせ取得 */
        $unreadNotifications = $this->getUnreadNotifications->invoke($user);

        /**
         * 最新10件を取って、直近の日記表示用に振り分け.
         */
        $zeroDayAgoDiary = null;
        $oneDayAgoDiary = null;
        $twoDayAgoDiary = null;
        $threeDayAgoDiary = null;

        $latestDiaries = [];
        foreach ($this->getLatestDiaries->invoke() as $targetDiary) {
            match ($targetDiary['date']) {
                $zeroDayYmd  => $zeroDayAgoDiary = $targetDiary,
                $oneDayYmd   => $oneDayAgoDiary = $targetDiary,
                $twoDayYmd   => $twoDayAgoDiary = $targetDiary,
                $threeDayYmd => $threeDayAgoDiary = $targetDiary,
                default      => $latestDiaries[] = $targetDiary,
            };
        }

        /**
         * 古い日記の取得処理.
         */
        /** 日付が同じ別の年の日記を取得 */
        $sameDayDiaries = $this->getSameDayDiariesByDate->invoke($carbonImmutableToday);

        /**
         * 先週、先月、2ヶ月前、半年前の日記を取得.
         *
         * @todo 変数名要検討
         * @todo 先週、みたいな表記はフロントエンドでやる(Day.jsなど使って)
         */
        $recentDiaries = $this->getDiariesByArray->invoke([
            $carbonImmutableToday->subWeek()->format('Y-m-d'),
            $carbonImmutableToday->subMonth()->format('Y-m-d'),
            $carbonImmutableToday->subMonths(2)->format('Y-m-d'),
            $carbonImmutableToday->subMonths(6)->format('Y-m-d'),
        ]);

        /** 過去の日記表示配列 +だと一部消えるのでarray_merge */
        $oldDiaries = array_merge($recentDiaries, $sameDayDiaries);

        return new JsonResponse(
            [
                'unreadNotifications' => $unreadNotifications,
                'oldDiaries'          => $oldDiaries,
                'zeroDayAgoDiary'     => $zeroDayAgoDiary,
                'oneDayAgoDiary'      => $oneDayAgoDiary,
                'twoDayAgoDiary'      => $twoDayAgoDiary,
                'threeDayAgoDiary'    => $threeDayAgoDiary,
                'latestDiaries'       => $latestDiaries,
            ]
        );
    }
}
