<?php

declare(strict_types=1);

namespace App\Http\Actions\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

final class UpdatePasswordAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        // バリデーション
        $this->validate($request, User::$updatePassWordRules);


        $user_id = Auth::user()->id;
        User::where("id", $user_id)->update([
            "password" => Hash::make($request->password),
        ]);
        return redirect("/security");
    }
}
