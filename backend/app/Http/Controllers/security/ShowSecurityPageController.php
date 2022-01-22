<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User_ip;
use Illuminate\Support\Facades\Auth;

class ShowSecurityPageController extends Controller
{
    public function __invoke(){
        $user=Auth::user();
        $user_ip=User_ip::get();
    return view('diary/security/home',["user"=>$user,"user_ip"=>$user_ip]);
    }
}