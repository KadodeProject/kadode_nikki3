<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRank;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

final class ShowSettingsAction extends Controller
{
    public function __invoke(): View|Factory
    {
        // ここはグローバルスコープ適応外
        $user = Auth::user();
        $userCounter = User::count();
        $user_rank = UserRank::where("id", $user->user_rank_id)->first();

        return view('diary/setting', ["user_rank" => $user_rank, "user" => $user, 'userCounter' => $userCounter]);
    }
}
