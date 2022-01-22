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
        $user_ips=User_ip::get()->reverse();
    return view('diary/security/home',["user"=>$user,"user_ips"=>$user_ips]);
    }
}