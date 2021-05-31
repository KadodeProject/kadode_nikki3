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
    public function get($uuid){

        $diary=Diary::where("uuid",$uuid)->first();
        return view('diary/edit',['diary' => $diary,]);
    }
    public function post(Request $request){
        $request->date=$request->date ?? Carbon::today()->format("y-m-d");
        
        // バリデーション
        // $this->validate($request,Diary::$rules);
        
        $form=[
            "user_id"=>Auth::id(),
            "title"=>$request->title,
            "content"=>$request->content,
            "date"=>$request->date,
            "feel"=>$request->feel,
            "uuid"=>Str::uuid(),
        ];

        Diary::create($form);
        return redirect('home');
    }
    public function update(Request $request){
        $updateContent=[
            "title"=>$request->title,
            "content"=>$request->content,
            "date"=>$request->content,
            "feel"=>$request->feel,
        ];
        Diary::where('uuid',$request->uuid)->save($updateContent);
        return redirect('home');
    }
    public function delete(Request $request){
        Diary::where('uuid',$request->uuid)->delete();
        return redirect('home');
    }

   
}