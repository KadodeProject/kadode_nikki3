<?php

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
    public function representative($request, Closure $next, $guard = null)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->user_role_id != 1 ? abort(403) : '';
        return $next($request);
    }
    public function systemAdministrator($request, Closure $next, $guard = null)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->user_role_id != 10 ? abort(403) : '';
        return $next($request);
    }
    public function management($request, Closure $next, $guard = null)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->user_role_id != 20 ? abort(403) : '';
        return $next($request);
    }
    public function mainEntrance($request, Closure $next, $guard = null)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->user_role_id != 30 ? abort(403) : '';
        return $next($request);
    }
    public function temporaryEntrance($request, Closure $next, $guard = null)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->user_role_id != 40 ? abort(403) : '';
        return $next($request);
    }
    public function graduates($request, Closure $next, $guard = null)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->user_role_id != 50 ? abort(403) : '';
        return $next($request);
    }
    public function outside($request, Closure $next, $guard = null)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->user_role_id != 60 ? abort(403) : '';
        return $next($request);
    }
}