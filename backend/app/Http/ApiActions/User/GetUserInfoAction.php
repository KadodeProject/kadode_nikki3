<?php

declare(strict_types=1);

namespace App\Http\ApiActions\User;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class GetUserInfoAction extends Controller
{
    public function __invoke(): JsonResponse
    {
        $user = Auth::user();
        if (null === $user) {
            // 認証されていない場合の処理
            throw new AuthenticationException();
        }

        return response()->json(
            [
                'id' => $user->id,
                'name' => $user->name,
            ]
        );
    }
}
