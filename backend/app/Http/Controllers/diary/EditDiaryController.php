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
    /**
     * Undocumented function
     *
     * @param [type] $uuid
     * @return void
     */
    public function get($uuid){

        $diary=Diary::where("uuid",$uuid)->first();
        $diary->feel=$diary->feel-1;//JSのセレクターの都合で-1している
        return view('diary/edit',['diary' => $diary,]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request){
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
    
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request){


        // 日付のバリデーション→既に存在する日付ならエラー返す

        
        $updateContent=[
            "title"=>$request->title,
            "content"=>$request->content,
            "date"=>$request->date,
            "feel"=>$request->feel,
        ];
        Diary::where('uuid',$request->uuid)->update($updateContent);
        return redirect('home');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request){
        \Log::debug("uuid".$request->uuid);
        Diary::where('uuid',$request->uuid)->delete();
        \Log::debug("deleted");
        return redirect('home');
    }

   
}