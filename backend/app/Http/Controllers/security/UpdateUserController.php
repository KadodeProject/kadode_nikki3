<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateUserController extends Controller
{
    /**
     * ユーザー削除
     *
     * @return void
     */
    public function deleteUser()
    {
        User::destroy(Auth::id());
        return redirect("/");
    }

    public function updateEmail(Request $request)
    {

        // バリデーション
        $this->validate($request, User::$updateEmailRules);


        $user_id = Auth::user()->id;
        User::where("id", $user_id)->update([
            "email" => $request->email,
        ]);
        return redirect("/security");
    }
    public function updatePassWord(Request $request)
    {

        // バリデーション
        $this->validate($request, User::$updatePassWordRules);


        $user_id = Auth::user()->id;
        User::where("id", $user_id)->update([
            "password" => Hash::make($request->password),
        ]);
        return redirect("/security");
    }
    public function updateUserName(Request $request)
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