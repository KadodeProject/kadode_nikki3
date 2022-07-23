<?php

declare(strict_types=1);

namespace App\Http\Actions\UserRank;

use App\Http\Controllers\Controller;
use App\Models\User_rank;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class UpdateUserRankAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        // バリデーション
        $this->validate($request, User_rank::$rules);

        $updateContent = [
            "name" => $request->name,
            "description" => $request->description,
        ];

        User_rank::where('id', $request->user_rank_id)->update($updateContent);
        return redirect(route('ShowAdminRoleRank'));
    }
}
