<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\Osirase;
use App\Models\Releasenote;
use App\Models\User_rank;
use App\UseCases\Diary\ShapeStatisticFromDiaries;
use DateTimeImmutable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

final class ShowHomeAction extends Controller
{
    public function __construct(
        private ShapeStatisticFromDiaries $shapeStatisticFromDiaries
    ) {
    }

    public function __invoke(): View|Factory
    {
        //ログインユーザーデーターの取得
        $user = Auth::user();
        $today_date = Carbon::today();
        $yesterday_date = Carbon::yesterday();


        /**
         * 最新10件を取って、今日と昨日があるか調べる
         * →あったら代入、
         *
         * さらに、下で挿入するようのデータは特定文字数超えたら切って「…」にする。
         */
        $today = null;
        $yesterday = null;
        $diaries = null;
        $latests = Diary::orderby("date", "desc")->take(10)->get();
        $latests = $this->shapeStatisticFromDiaries->invoke($latests);

        /**
         * 今日と昨日の日記があるか調べる
         */
        foreach ($latests as $latest) {
            $date    = Carbon::parse($latest->date);
            if ($today_date->eq($date)) {
                $today = $latest;
            } else if ($yesterday_date->eq($date)) {
                $yesterday = $latest;
            } else {
                $diaries[] = $latest;
            }
        }

        $this_day = Carbon::today()->format("Y-m-d");



        /**
         * 古い日記の取得
         */
        $lastWeek = new Carbon("-1 weeks");
        $lastWeekDiary = Diary::where("date", $lastWeek->format("Y-m-d"))->first();
        $lastWeekDiary = ["explain" => "先週"] + ($lastWeekDiary ? $lastWeekDiary->toArray() : ["date" => "no"]);

        $lastMonth = new Carbon("-1 months");
        $lastMonthDiary = Diary::where("date", $lastMonth->format("Y-m-d"))->first();
        $lastMonthDiary = ["explain" => "先月"] + ($lastMonthDiary ? $lastMonthDiary->toArray() : ["date" => "no"]);

        $lastTwoMonth = new Carbon("-2 months");
        $lastTwoMonthDiary = Diary::where("date", $lastTwoMonth->format("Y-m-d"))->first();
        $lastTwoMonthDiary = ["explain" => "2ヶ月前"] + ($lastTwoMonthDiary ? $lastTwoMonthDiary->toArray() : ["date" => "no"]);


        $halfYear = new Carbon("-6 months");
        $halfYearDiary = Diary::where("date", $halfYear->format("Y-m-d"))->first();
        $halfYearDiary = ["explain" => "半年前"] + ($halfYearDiary ? $halfYearDiary->toArray() : ["date" => "no"]);

        $lastYear = new Carbon("-1 years");
        $lastYearDiary = Diary::where("date", $lastYear->format("Y-m-d"))->first();
        $lastYearDiary = ["explain" => "1年前"] + ($lastYearDiary ? $lastYearDiary->toArray() : ["date" => "no"]);


        $lastTwoYear = new Carbon("-2 years");
        $lastTwoYearDiary = Diary::where("date", $lastTwoYear->format("Y-m-d"))->first();
        $lastTwoYearDiary = ["explain" => "2年前"] + ($lastTwoYearDiary ? $lastTwoYearDiary->toArray() : ["date" => "no"]);

        $lastThreeYear = new Carbon("-3 years");
        $lastThreeYearDiary = Diary::where("date", $lastThreeYear->format("Y-m-d"))->first();
        $lastThreeYearDiary = ["explain" => "3年前"] + ($lastThreeYearDiary ? $lastThreeYearDiary->toArray() : ["date" => "no"]);

        $lastFourYear = new Carbon("-4 years");
        $lastFourYearDiary = Diary::where("date", $lastFourYear->format("Y-m-d"))->first();
        $lastFourYearDiary = ["explain" => "4年前"] + ($lastFourYearDiary ? $lastFourYearDiary->toArray() : ["date" => "no"]);


        $oldDiaries = [$lastWeekDiary, $lastMonthDiary, $lastTwoMonthDiary, $halfYearDiary, $lastYearDiary, $lastTwoYearDiary, $lastThreeYearDiary, $lastFourYearDiary];
        /**
         * oldDiariesの統計データの表示処理
         *
         */
        /**
         * →→ここだけ他と処理が異なり、関数家できない！！！！！
         */
        $i = 0;
        foreach ($oldDiaries as $diary) {
            if ($diary['date'] !== "no") {
                $oldDiariesDate = new DateTimeImmutable($oldDiaries[$i]["date"]);
                $oldDiaries[$i]["date"] = $oldDiariesDate->format("Y年n月j日");
                $oldDiaries[$i]["is_latest_statistic"] = false;
                //統計データがあり、その統計データが日記の内容と合致しているかの判断
                if (isset($oldDiaries[$i]["updated_statistic_at"])) {
                    $diary_update = new Carbon($oldDiaries[$i]["updated_at"]);
                    $stati_update = new Carbon($oldDiaries[$i]["updated_statistic_at"]);
                    //gtでgreater than 日付比較
                    if ($oldDiaries[$i]["statistic_progress"] === 100 && $stati_update->gt($diary_update)) {
                        $oldDiaries[$i]["is_latest_statistic"] = true;
                        $oldDiaries[$i]["important_words"] = array_values(json_decode($diary["important_words"], true));
                        $oldDiaries[$i]["special_people"] = array_values(json_decode($diary["special_people"], true));
                    }
                }
            }
            $i += 1;
        }
        //oldDiariesの統計データの表示処理ここまで

        //古い日記の取得


        /**
         * ユーザーのお知らせ取得
         */
        $new_infos = [];


        if (!$user->is_showed_service_info) {
            //お知らせ取得
            $osirase = Osirase::where("id", "!=", 0)->orderBy('date', 'desc')->first(['title', 'date']);
            $new_infos[] = ["url" => "/osirase", "actionUrl" => route('RemoveOsiraseInfo'), "bg_color" => "51, 118, 156", "title" => $osirase->title, "date" => $osirase->date];
        }
        if (!$user->is_showed_update_system_info) {
            // リリースノート取得
            $releasenote = Releasenote::where("id", "!=", 0)->orderBy('date', 'desc')->first(['title', 'date']);
            $new_infos[] = ["url" => "/releaseNote", "actionUrl" => route('RemoveReleasenoteInfo'), "bg_color" => "51, 156, 118", "title" => $releasenote->title, "date" => $releasenote->date];
        }
        if (!$user->is_showed_update_user_rank) {
            // ユーザーランク取得
            $user_rank = User_rank::where("id", $user->user_rank_id)->first(['name']);
            $new_infos[] = ["url" => "/settings", "actionUrl" => route('RemoveUserRankInfo'), "bg_color" => "226, 83, 74", "title" => "ユーザーランクが「" . $user_rank->name . "」になりました！", "date" => $user->user_rank_updated_at];
        }


        return view('diary/home', ['user' => $user, 'new_infos' => $new_infos, 'yesterday' => $yesterday, 'today' => $today, 'diaries' => $diaries, 'this_day' => $this_day, 'oldDiaries' => $oldDiaries]);
    }
}