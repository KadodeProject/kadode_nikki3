<?php

declare(strict_types=1);

namespace App\Http\ApiActions;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class GetApiStatus extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(
            ['status' => '✌']
        );
    }
}
