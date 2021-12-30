<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Illuminate\Support\Carbon
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
        if($diary==null){
            //日記無かったらリダイレクトさせる
            return redirect("home");
        }
        $next=Diary::where("date",">",$diary->date)->orderBy("date","asc")->first();
        $previous=Diary::where("date","<",$diary->date)->orderBy("date","desc")->first();

        //日記の統計情報取得
        $diary->is_latest_statistic=false;
        $diary_update= new Carbon($diary->updated_at);
        $stati_update=new Carbon($diary->updated_statistic_at);

        //最新の情報のときのみ
        if($diary->statistic_progress==100 && $stati_update->gt($diary_update)){
            /**
             * 名詞と形容詞の登場順
             */
            //jsonを配列に戻し、連想配列を配列にする
            $diary->is_latest_statistic=true;
            $diary->important_words=array_values(json_decode($diary->important_words,true));
            // \Log::debug($diary->affiliation);
            $diary->special_people=array_values(json_decode($diary->special_people,true));
        }

        return view('diary/edit',['diary' => $diary,'previous'=>$previous, 'next'=>$next]);
    }

    public function newPage(){
        return view('diary/newDiary');
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
        $this->validate($request,Diary::$rules);

        $form=[
            "user_id"=>Auth::id(),
            "title"=>$request->title,
            "content"=>$request->content,
            "date"=>$request->date,
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
        // バリデーション
        $this->validate($request,Diary::$rules);

        $updateContent=[
            "title"=>$request->title,
            "content"=>$request->content,
            "date"=>$request->date,
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
        Diary::where('uuid',$request->uuid)->delete();
        return redirect('home');
    }


}
