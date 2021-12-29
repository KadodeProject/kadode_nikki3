<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SettingDiaryController extends Controller
{
    public function __invoke()
    {

        // ここはグローバルスコープ適応外
        $user=Auth::user();
        $userCounter=User::count();

        $userDB=User::where("id",$user->id)->first();

        return view('diary/setting',["user"=>$user,"userDB"=>$userDB,'userCounter'=>$userCounter]);

    }

}