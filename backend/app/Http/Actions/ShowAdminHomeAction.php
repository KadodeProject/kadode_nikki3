<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Diary;
use App\Models\User;
use App\Models\Statistic_per_month;
use App\Models\Statistic;

final class ShowAdminHomeAction extends Controller
{
    public function __invoke(): View|Factory
    {
        $users = User::get();
        foreach ($users as $user) {
            $statistic = ""; //怖いので初期化
            //日記数統計から取ってきていないのは統計データーがそもそも無いが、日記はある可能性があるため
            $user->diary_count = Diary::withoutGlobalScopes()->where("user_id", $user->id)->count() ?? 0;
            $user->latest_diary = Diary::withoutGlobalScopes()->where("user_id", $user->id)->orderBy("date", "desc")->first(['date'])->date ?? 'なし';
            $user->oldest_diary = Diary::withoutGlobalScopes()->where("user_id", $user->id)->orderBy("date", "asc")->first(['date'])->date ?? 'なし';
            $user->statistics_per_month_count = Statistic_per_month::withoutGlobalScopes()->where("user_id", $user->id)->count() ?? 0;
            $user->diary_average = "未測定"; //無い可能性もあるので0に
            $statistic = Statistic::withoutGlobalScopes()->where("user_id", $user->id)->first(['statistic_progress', 'total_words', 'total_diaries']);
            if (!empty($statistic)) {
                //統計あっても生成中の可能性があるので
                if ($statistic->statistic_progress == 100) {
                    $user->diary_average = round($statistic->total_words / $statistic->total_diaries);
                } else {
                    $user->diary_average = "生成中"; //無い可能性もあるので0に
                }
            }
        }

        return view('admin/homeAdmin', ['users' => $users]);
    }
}
