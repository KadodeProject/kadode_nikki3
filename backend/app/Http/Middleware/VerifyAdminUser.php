<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyAdminUser
{
    /**
     * @param Request $request
     * @param null    $guard
     */
    public function handle($request, \Closure $next, $guard = null): mixed
    {
        /** @var User $user */
        $user = Auth::user();

        if (2 !== $user->user_role_id) {
            // 管理者ユーザーじゃなかったら403エラー返す
            abort(403);
        }

        return $next($request);
    }
}
