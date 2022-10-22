<?php

declare(strict_types=1);

namespace App\Http\Actions\UserRole;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class DeleteUserRoleAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        UserRole::where('id', $request->user_role_id)->delete();

        return redirect(route('ShowAdminRoleRank'));
    }
}
