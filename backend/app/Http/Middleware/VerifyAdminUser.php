<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyAdminUser
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->user_role_id !== 2) {
            //管理者ユーザーじゃなかったら403エラー返す
            abort(403);
        }

        return $next($request);
    }
}