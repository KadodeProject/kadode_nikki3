<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardDiaryController extends Controller
{
    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function __invoke()
    {
        //ログインユーザーデーターの取得
        $user = Auth::user();
        return view('diary/dashboard',['user' => $user,]);
    }
}
