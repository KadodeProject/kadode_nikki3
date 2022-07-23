<?php

declare(strict_types=1);

namespace App\Http\Actions\UserRank;

use App\Http\Controllers\Controller;
use App\Models\User_rank;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class DeleteUserRankAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        User_rank::where('id', $request->user_rank_id)->delete();
        return redirect(route('ShowAdminRoleRank'));
    }
}
