<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EditDiaryController extends Controller
{
    public function get(){
        $user = Auth::user();
        return view('diary/edit',['user' => $user,]);
    }
    public function post(Request $request){
        // バリデーション
        $request->date=$request->date ?? Carbon::today()->format("y-m-d");
        \Log::debug( $request->date);
        // $this->validate($request,Diary::$rules);
        
        $user = Auth::user();
        \Log::debug( $user);
        $form=[
            "user_id"=>$user->id,
            "title"=>$request->title,
            "content"=>$request->content,
            "date"=>$request->date,
            "feel"=>$request->feel,
            "uuid"=>Str::uuid(),
        ];
        \Log::debug( $form);
        Diary::create($form);
        return view('diary');
    }
    public function update(Request $request){
        $updateContent=[
            "title"=>$request->title,
            "content"=>$request->content,
            "date"=>$request->content,
            "feel"=>$request->feel,
        ];
        Diary::where('uuid',$request->uuid)->save($updateContent);
        return view('diary');
    }
    public function delete(Request $request){
        Diary::where('uuid',$request->uuid)->delete();
        return view('diary');
    }

   
}