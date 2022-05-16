<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\NERLabel;
use App\Models\NlpPackageGenre;
use App\Models\NlpPackageName;
use App\Models\PackageNER;
use App\UseCases\NERLabel\GetAllNERLabelInOptionTabFormat;

class PackageAdminController extends Controller
{
    public function __construct(
        public GetAllNERLabelInOptionTabFormat $getAllNERLabelInOptionTabFormat
    ) {
    }
    public function __invoke()
    {
        //パッケージ表示(最近更新のあったものから取り出す)
        $NlpPackageName = NlpPackageName::withoutGlobalScopes()->orderBy('updated_at', 'desc')->get();
        //パッケージジャンル表示
        $NlpPackageGenre = NlpPackageGenre::get();
        //固有表現ルールの中身取得
        foreach ($NlpPackageName as $NlpPackageObj) {
            if ($NlpPackageObj->genre_id == 1) {
                //固有表現パッケージだったら
                $NlpPackageObj->packageNER = PackageNER::where('package_id', $NlpPackageObj->id)->get();
            }
        }
        //固有表現ラベル取得
        /** @todo ここで203回呼ばれて、これが繰り返しフィールドで適応されるので激重になります。 */
        $NERLabel = NERLabel::all();

        $NERLabelsInOptionTabFormat = $this->getAllNERLabelInOptionTabFormat->invoke();
        return view('admin/packageAdmin', ['NlpPackageName' => $NlpPackageName, 'NlpPackageGenre' => $NlpPackageGenre, 'NERLabel' => $NERLabel, 'NERLabelsInOptionTabFormat' => $NERLabelsInOptionTabFormat,]);
    }
}