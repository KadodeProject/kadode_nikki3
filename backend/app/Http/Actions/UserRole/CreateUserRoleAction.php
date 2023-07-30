<?php

declare(strict_types=1);

namespace App\Http\Actions\UserRole;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class CreateUserRoleAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        // バリデーション
        $this->validate($request, UserRole::$rules);

        // 中身作成
        $form = [
            'name'        => $request->name,
            'description' => $request->description,
        ];

        UserRole::create($form);

        return redirect(route('ShowAdminRoleRank'));
    }
}
