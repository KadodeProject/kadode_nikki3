<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomNER;
use App\Models\NERLabel;
use Illuminate\Support\Facades\Auth;
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
        
        // バリデーション
        $this->validate($request,CustomNER::$rules);
        
        //ラベルidの取得
        $label_id=NERLabel::where('label',$request->label)->first();
        //中身作成
        $form=[
            "user_id"=>Auth::id(),
            "label_id"=>$label_id,
            "name"=>$request->name,
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

        //ラベルidの取得
        $label_id=NERLabel::where($request->label,'label')->first();
        
        $updateContent=[
            "label_id"=>$label_id,
            "name"=>$request->name,
        ];
        CustomNER::where('id',$request->customNER_id)->update($updateContent);
        return redirect('statistics/settings');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function customDelete(Request $request){
        CustomNER::where('id',$request->customNER_id)->delete();
        return redirect('statistics/settings');
    }


    public function packagesCreate(Request $request){}
    public function packagesUpdate(Request $request){}
    public function packagesDelete(Request $request){}
}