<?php

declare(strict_types=1);

namespace App\Http\Actions\UserRank;

use App\Http\Controllers\Controller;
use App\Models\UserRank;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class UpdateUserRankAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        // バリデーション
        $this->validate($request, UserRank::$rules);

        $updateContent = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        UserRank::where('id', $request->user_rank_id)->update($updateContent);

        return redirect(route('ShowAdminRoleRank'));
    }
}
