<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

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
        $user = $request->user();

        if (!$user->id==1) {
            //管理者ユーザーじゃなかったら403エラー返す
            abort(403);
        }

        return $next($request);
    }
}