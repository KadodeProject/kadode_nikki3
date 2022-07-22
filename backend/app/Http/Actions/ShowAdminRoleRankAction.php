<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Controllers\Controller;
use App\Models\User_rank;
use App\Models\User_role;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class ShowAdminRoleRankAction extends Controller
{
    public function __invoke(): View|Factory
    {
        //ユーザーランク
        $user_ranks = User_rank::get();

        //ユーザーロール
        $user_roles = User_role::get();

        return view('admin/role_rankAdmin', ['user_ranks' => $user_ranks, 'user_roles' => $user_roles,]);
    }
}
