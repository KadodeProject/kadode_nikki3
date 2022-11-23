<?php

declare(strict_types=1);

namespace App\Http\ApiActions\MachineResource;

use App\Http\Controllers\Controller;
use App\Models\MachineResource;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

final class GetMachineResourceLatestMonth extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(
            // idが遅いほど新しいデータなのでidの降順にすることで手前ほど新しいデータにする
            MachineResource::where('created_at', '>=', Carbon::now()->subMonth())->orderBy('id', 'desc')->get()
        );
    }
}
