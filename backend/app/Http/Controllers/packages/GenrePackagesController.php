<?php

namespace App\Http\Controllers\packages;

use App\Http\Controllers\Controller;
use App\Models\NlpPackageGenre;
use Illuminate\Http\Request;

class GenrePackagesController extends Controller
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
        $this->validate($request, NlpPackageGenre::$rules);

        //中身作成
        $form = [
            "description" => $request->description,
            "name" => $request->name,
        ];

        NlpPackageGenre::create($form);
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
        $this->validate($request, NlpPackageGenre::$rules);

        $updateContent = [
            "description" => $request->description,
            "name" => $request->name,
        ];

        NlpPackageGenre::where('id', $request->NlpPackageGenre_id)->update($updateContent);
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
        NlpPackageGenre::where('id', $request->NlpPackageGenre_id)->delete();
        return redirect('administrator/package');
    }
}