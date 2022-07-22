<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageNER;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

class NamedEntityStatisticsController extends Controller
{
    // パッケージNERのCRUD周り


    public function packagesCreate(Request $request): Redirector|RedirectResponse
    {

        // バリデーション
        $this->validate($request, PackageNER::$rules);

        //中身作成
        $form = [
            "package_id" => $request->packageId,
            "label_id" => $request->label_id,
            "name" => $request->name,
        ];

        PackageNER::create($form);
        return redirect('administrator/package/' . $request->packageId);
    }

    public function packagesUpdate(Request $request): Redirector|RedirectResponse
    {
        // 日付のバリデーション→既に存在する日付ならエラー返す
        // バリデーション
        $this->validate($request, PackageNER::$rules);

        $updateContent = [
            "label_id" => $request->label_id,
            "name" => $request->name,
        ];

        PackageNER::where('id', $request->PackageNER_id)->update($updateContent);
        return redirect('administrator/package/' . $request->packageId);
    }

    public function packagesDelete(Request $request): Redirector|RedirectResponse
    {
        PackageNER::where('id', $request->PackageNER_id)->delete();
        return redirect('administrator/package/' . $request->packageId);
    }
}
