<?php

declare(strict_types=1);

namespace App\Http\Actions\Statistic;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use App\UseCases\Statistic\ThrowPythonNLP;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * 新規作成
 */
class CreateAllStatisticAction extends Controller
{
    public function __construct(
        public ThrowPythonNLP $throwPythonNLP
    ) {
    }

    public function __invoke(): Redirector|RedirectResponse
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
        // // StatisticPerMonth::create($data);
        // // StatisticPerYear::create($data);
        // // Diary_people::create($data);
        // StatisticOverallProgress::create($data);

        /**
         * ここからPython
         */
        $this->throwPythonNLP->invoke($userId);

        return redirect(route('ShowStatistic'));
    }
}