<?php

declare(strict_types=1);

namespace App\Http\Actions\Statistic;

use App\Http\Controllers\Controller;
use App\UseCases\Statistic\ThrowPythonNLP;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Statistic;

class UpdateAllStatisticAction extends Controller
{
    public function __construct(
        public ThrowPythonNLP $throwPythonNLP
    ) {
    }

    public function __invoke(): Redirector|RedirectResponse
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
