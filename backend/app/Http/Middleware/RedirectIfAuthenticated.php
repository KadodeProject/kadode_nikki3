<?php

namespace App\Http\Middleware;

use App\Models\User_ip;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {



        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // //DBにipアドレス格納
                $ip=$request->ip();
                $data=[
                    "user_id"=>Auth::id(),
                    "ip"=>$ip,
                    "ua"=>$request->header('User-Agent'),
                    "geo"=>geoip($ip),
                ];
                User_ip::create($data);

                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}