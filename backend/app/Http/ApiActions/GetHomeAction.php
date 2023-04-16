<?php

declare(strict_types=1);

namespace App\Http\ApiActions;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

final class GetHomeAction extends Controller
{
    public function __invoke(): JsonResponse
    {
        $user = Auth::user();
        if ($user === null) {
            // 認証されていない場合の処理
            throw new AuthenticationException();
        }
        return new JsonResponse([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
        ]);
    }
}
