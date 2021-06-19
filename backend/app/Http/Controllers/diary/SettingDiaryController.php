<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingDiaryController extends Controller
{
    public function __invoke()
    {
        $user=Auth::user();
        $userDB=User::where("id",$user->id)->first();

        $userCounter=User::count();
        return view('diary/setting',["user"=>$user,"userDB"=>$userDB,'userCounter'=>$userCounter]);

    }

}
