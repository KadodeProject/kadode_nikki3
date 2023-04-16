<?php

declare(strict_types=1);

namespace App\Http\ApiActions\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class GetUserInfoAction extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(
            [
                'id' => Auth::id(),
                'name' => Auth::user()->name,
            ]
        );
    }
}
