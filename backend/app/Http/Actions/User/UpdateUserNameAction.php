<?php

declare(strict_types=1);

namespace App\Http\Actions\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

final class UpdateUserNameAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        // バリデーション
        $this->validate($request, User::$updateUserNameRules);


        $user_id = Auth::user()->id;
        User::where("id", $user_id)->update([
            "name" => $request->name,
        ]);
        return redirect("/security");
    }
}
