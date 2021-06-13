<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * ユーザー削除
     *
     * @return void
     */
    public function deleteUser(){
        User::destroy(Auth::id());
        return redirect("/");
    }
}