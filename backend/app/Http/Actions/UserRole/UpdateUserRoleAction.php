<?php

declare(strict_types=1);

namespace App\Http\Actions\UserRole;

use App\Http\Controllers\Controller;
use App\Models\User_role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class UpdateUserRoleAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        // バリデーション
        $this->validate($request, User_role::$rules);

        $updateContent = [
            "name" => $request->name,
            "description" => $request->description,
        ];

        User_role::where('id', $request->user_role_id)->update($updateContent);
        return redirect('administrator/role_rank');
    }
}
