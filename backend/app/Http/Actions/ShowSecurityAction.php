<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Controllers\Controller;
use App\Models\UserIp;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class ShowSecurityAction extends Controller
{
    public function __invoke(Request $request): View|Factory
    {
        $user = Auth::user();
        $user_ips = UserIp::get()->reverse();
        return view('diary/security/home', ["user" => $user, "user_ips" => $user_ips]);
    }
}
