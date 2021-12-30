<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomNER;
use App\Models\NERLabel;
use App\Models\PackageNER;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon

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

        //中身作成
        $form=[
            "user_id"=>Auth::id(),
            "label_id"=>$request->label_id,
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

        $updateContent=[
            "label_id"=>$request->label_id,
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


    // パッケージNERのCRUD周り


    public function packagesCreate(Request $request){

        // バリデーション
        $this->validate($request,PackageNER::$rules);

        //中身作成
        $form=[
            "package_id"=>$request->package_id,
            "label_id"=>$request->label_id,
            "name"=>$request->name,
        ];

        PackageNER::create($form);
        return redirect('administrator');
    }
    public function packagesUpdate(Request $request){
          // 日付のバリデーション→既に存在する日付ならエラー返す
        // バリデーション
        $this->validate($request,PackageNER::$rules);

        $updateContent=[
            "label_id"=>$request->label_id,
            "name"=>$request->name,
        ];

        PackageNER::where('id',$request->PackageNER_id)->update($updateContent);
        return redirect('administrator');
    }
    public function packagesDelete(Request $request){
        PackageNER::where('id',$request->PackageNER_id)->delete();
        return redirect('administrator');
    }
}
