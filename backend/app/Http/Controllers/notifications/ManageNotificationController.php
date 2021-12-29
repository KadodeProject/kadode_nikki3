<?php

namespace App\Http\Controllers\notifications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManageNotificationController extends Controller
{
    public function user_rank(){
        User::where('id',Auth::id())->update(["is_showed_update_user_rank"=>1]);
        return redirect('home');
    }

    public function osirase(){
        User::where('id',Auth::id())->update(["is_showed_service_info"=>1]);
        return redirect('home');
    }

    public function releasenote(){
        User::where('id',Auth::id())->update(["is_showed_update_system_info"=>1]);
        return redirect('home');
    }
}