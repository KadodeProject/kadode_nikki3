<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Controllers\Controller;
use App\Models\UserRank;
use App\Models\UserRole;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class ShowAdminRoleRankAction extends Controller
{
    public function __invoke(): View|Factory
    {
        //ユーザーランク
        $user_ranks = UserRank::get();

        //ユーザーロール
        $user_roles = UserRole::get();

        return view('admin/role_rankAdmin', ['user_ranks' => $user_ranks, 'user_roles' => $user_roles,]);
    }
}
