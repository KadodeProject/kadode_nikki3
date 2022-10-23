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
            OperationCoreTransitionPerHour::where('created_at', '>=', Carbon::now()->subWeek())->get()
        );
    }
}
