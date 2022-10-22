<?php

declare(strict_types=1);

namespace App\Http\Actions\UserRank;

use App\Http\Controllers\Controller;
use App\Models\UserRank;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class CreateUserRankAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        // バリデーション
        $this->validate($request, UserRank::$rules);

        // 中身作成
        $form = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        UserRank::create($form);

        return redirect(route('ShowAdminRoleRank'));
    }
}
