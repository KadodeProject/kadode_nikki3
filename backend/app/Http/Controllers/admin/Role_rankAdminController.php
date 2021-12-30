<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User_rank;
use App\Models\User_role;

class Role_rankAdminController extends Controller
{
    public function __invoke()
    {
        //ユーザーランク
        $user_ranks=User_rank::get();

        //ユーザーロール
        $user_roles=User_role::get();

        return view('admin/role_rankAdmin',['user_ranks' => $user_ranks,'user_roles' => $user_roles,]);
    }

}