<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomNER;
use Carbon\Carbon;

class NamedEntityStatisticsController extends Controller
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function customCreate(Request $request){
        $request->date=$request->date ?? Carbon::today()->format("y-m-d");
        
        // バリデーション
        $this->validate($request,CustomNER::$rules);
        
        $form=[
            "user_id"=>Auth::id(),
            "title"=>$request->title,
            "content"=>$request->content,
            "date"=>$request->date,
            "uuid"=>Str::uuid(),
        ];

        CustomNER::create($form);
        return redirect('statistics/settings');
    }
    
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function customUpdate(Request $request){


        // 日付のバリデーション→既に存在する日付ならエラー返す
        // バリデーション
        $this->validate($request,CustomNER::$rules);
        
        $updateContent=[
            "title"=>$request->title,
            "content"=>$request->content,
            "date"=>$request->date,
        ];
        CustomNER::where('uuid',$request->uuid)->update($updateContent);
        return redirect('statistics/settings');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function customDelete(Request $request){
        CustomNER::where('uuid',$request->uuid)->delete();
        return redirect('statistics/settings');
    }


    public function packagesCreate(Request $request){}
    public function packagesUpdate(Request $request){}
    public function packagesDelete(Request $request){}
}