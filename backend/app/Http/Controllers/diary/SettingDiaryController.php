<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_rank;
use Illuminate\Support\Facades\Auth;

class SettingDiaryController extends Controller
{
    public function __invoke()
    {

        // ここはグローバルスコープ適応外
        $user = Auth::user();
        $userCounter = User::count();
        $user_rank = User_rank::where("id", $user->user_rank_id)->first();

        return view('diary/setting', ["user_rank" => $user_rank, "user" => $user, 'userCounter' => $userCounter]);
    }
}