<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EditDiaryController extends Controller
{
    public function get(){
        $user = Auth::user();
        return view('diary/dashboard',['user' => $user,]);
    }
    public function post($request){
        // バリデーション
        $this->validate($request,Diary::$rules);
        $user = Auth::user();
        $form=[
            "user_id"=>$user->id,
            "title"=>$request->title,
            "content"=>$request->content,
            "date"=>$request->date,
            "feel"=>$request->feel,
            "uuid"=>Str::uuid(),
        ];
        Diary::create($form);
        return view('diary/dashboard',['user' => $user,]);
    }
    public function update($request){
        $user = Auth::user();
        return view('diary/dashboard',['user' => $user,]);
    }
    public function delete($request){
        $user = Auth::user();
        return view('diary/dashboard',['user' => $user,]);
    }

   
}