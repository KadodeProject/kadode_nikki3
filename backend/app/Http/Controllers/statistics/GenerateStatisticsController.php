<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use App\Models\Statistic_overall_progress;
use App\UseCases\Statistic\ThrowPythonNLP;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class GenerateStatisticsController extends Controller
{

    public function __construct(
        public ThrowPythonNLP $throwPythonNLP
    ) {
    }

    /**
     * 新規作成
     */
    public function create()
    {
        $userId = Auth::id();
        $dt = new Carbon();
        $data = [
            "user_id" => $userId,
            'updated_at' => $dt,
            'statistic_progress' => 1,
        ];
        Statistic::create($data);
        // $data=[
        //     "user_id"=>Auth::id(),
        // ];
        // // Statistic_per_month::create($data);
        // // Statistic_per_year::create($data);
        // // Diary_people::create($data);
        // Statistic_overall_progress::create($data);

        /**
         * ここからPython
         */
        $this->throwPythonNLP->invoke($userId, false, false);

        return redirect("statistics/home");
    }

    /**
     * 更新
     */
    public function update()
    {
        $dt = new Carbon();
        $yesterday = $dt->subHour(24);
        $userId = Auth::id();
        $static = Statistic::where("user_id", $userId)->first();

        // 24時間以内なら更新しない
        if (($yesterday->diffInHours($static->updated_at)) >= 0) {
            // $diaries=Diary::orderby("date","asc")->get();
            // $calculateDiary=calculateDiary::calculateDiary($diaries);

            $data = [
                'statistic_progress' => 1,
                'updated_at' => $dt->addHour(24),
            ];
            $static->update($data);
            //自然言語処理↓
            $this->throwPythonNLP->invoke($userId, false, false);
        }
        return redirect("statistics/home");
    }
}