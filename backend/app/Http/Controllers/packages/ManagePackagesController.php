<?php

namespace App\Http\Controllers\packages;

use App\Http\Controllers\Controller;
use App\Models\NlpPackageName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagePackagesController extends Controller
{

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {

        // バリデーション
        $this->validate($request, NlpPackageName::$rules);

        //中身作成
        $form = [
            "user_id" => Auth::id(),
            "genre_id" => $request->NlpPackageGenre_id,
            "name" => $request->name,
            "description" => $request->description,
            "is_publish" => $request->is_publish,
        ];

        NlpPackageName::create($form);
        return redirect('administrator/package');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */

    public function update(Request $request)
    {


        // 日付のバリデーション→既に存在する日付ならエラー返す
        // バリデーション
        $this->validate($request, NlpPackageName::$rules);

        $updateContent = [
            "genre_id" => $request->NlpPackageGenre_id,
            "name" => $request->name,
            "description" => $request->description,
            "is_publish" => $request->is_publish,
        ];

        NlpPackageName::where('id', $request->NlpPackageName_id)->update($updateContent);
        return redirect('administrator/package');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request)
    {
        NlpPackageName::where('id', $request->NlpPackageName_id)->delete();
        return redirect('administrator/package');
    }
}