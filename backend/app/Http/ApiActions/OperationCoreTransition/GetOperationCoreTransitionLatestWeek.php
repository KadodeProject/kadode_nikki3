<?php

declare(strict_types=1);

namespace App\Http\ApiActions\OperationCoreTransition;

use App\Http\Controllers\Controller;
use App\Models\OperationCoreTransitionPerHour;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

final class GetOperationCoreTransitionLatestWeek extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(
            // idが遅いほど新しいデータなのでidの降順にすることで手前ほど新しいデータにする
            OperationCoreTransitionPerHour::where('created_at', '>=', Carbon::now()->subWeek())->orderBy('id', 'desc')->get()
        );
    }
}
