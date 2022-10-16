<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\Statistic;
use App\Models\StatisticPerMonth;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class ShowAdminHomeAction extends Controller
{
    /**
     * @todo ここは完全に壊れているが、うすゆきしか使用しない上、200で動くので、リプレースで消えるまで放置
     */
    public function __invoke(): View|Factory
    {
        $users = User::get();
        /**
         * @todo こことんでもない量のSQLが走ってしまうので要調整
         * @todo ただし、管理者ページは一般ユーザーアクセスしないので放置でもよいかも
         */
        foreach ($users as $user) {
            $statistic = ""; //怖いので初期化
            //日記数統計から取ってきていないのは統計データーがそもそも無いが、日記はある可能性があるため
            $user->diary_count = Diary::withoutGlobalScopes()->where("user_id", $user->id)->count() ?? 0;
            $user->latest_diary = Diary::withoutGlobalScopes()->where("user_id", $user->id)->orderBy("date", "desc")->first(['date'])->date ?? 'なし';
            $user->oldest_diary = Diary::withoutGlobalScopes()->where("user_id", $user->id)->orderBy("date", "asc")->first(['date'])->date ?? 'なし';
            $user->statistics_per_month_count = StatisticPerMonth::withoutGlobalScopes()->where("user_id", $user->id)->count() ?? 0;
            $user->diary_average = "未測定"; //無い可能性もあるので0に
            $statistic = Statistic::withoutGlobalScopes()->where("user_id", $user->id)->first(['statistic_progress', 'total_words', 'total_diaries']);
            if (!empty($statistic)) {
                //統計あっても生成中の可能性があるので
                if ($statistic->statistic_progress === 100) {
                    $user->diary_average = round($statistic->total_words / $statistic->total_diaries);
                } else {
                    $user->diary_average = "生成中"; //無い可能性もあるので0に
                }
            }
        }

        return view('admin/homeAdmin', ['users' => $users]);
    }
}