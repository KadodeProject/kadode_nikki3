<?php

declare(strict_types=1);

namespace App\Http\ApiActions\OperationCoreTransition;

use App\Http\Controllers\Controller;
use App\Models\OperationCoreTransitionPerHour;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

final class GetOperationCoreTransitionLatestMonth extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(
            // idが遅いほど新しいデータなのでidの降順にすることで手前ほど新しいデータにする
            // 1時間ごとだと月ごとのデータが多すぎるので、1日1つに制限する(date('G')で現在時間を取得できるので各日リクエストした時間帯の値を取ってくることで直近のデータとの齟齬を無くす)
            OperationCoreTransitionPerHour::where('created_at', '>=', Carbon::now()->subMonth())->whereRaw('hour(created_at) = ?', [date('G')])->orderBy('id', 'desc')->get()
        );
    }
}
