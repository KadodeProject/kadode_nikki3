<?php

declare(strict_types=1);

namespace App\Http\Actions\Statistic;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomNER;
use App\Models\NERLabel;
use App\Models\NlpPackageGenre;
use App\Models\NlpPackageName;
use App\Models\NlpPackageUser;

/**
 * 統計設定を表示する
 */
class ShowSettingAction extends Controller
{
    public function __invoke():View|Factory
    {
        //ユーザー定義固有表現ルール→ラベル名はbladeのif文で表示させるのでここではidのままでよい。
        $CustomNER = CustomNER::where('user_id', Auth::id())->get();

        //固有表現ラベル取得
        $NERLabel = NERLabel::where('id', '>', 0)->get()->all();
        //ラベルIDからラベル名を取得→不要

        //パッケージ取得
        /** ここ->get()->を外すと処理できなくなるので注意(不要に見えて必要) */
        $NlpPackageName = NlpPackageName::withoutGlobalScopes()->get()->all();

        //パッケージジャンル取得
        foreach ($NlpPackageName as $packageObj) {
            $packageObj->genre = NlpPackageGenre::where('id', $packageObj->genre_id)->first()->name;
        }


        //ユーザー有効化パッケージのidを取得
        $havingPackage = [];
        $havingPackageList = NlpPackageUser::where('user_id', Auth::id())->get(['package_id']);
        foreach ($havingPackageList as $havingPackageObj) {
            $havingPackage[] = $havingPackageObj->package_id;
        }
        return view('diary/statistics/settingsStatistics', ['CustomNER' => $CustomNER, 'NERLabel' => $NERLabel, 'NlpPackageName' => $NlpPackageName, 'havingPackageList' => $havingPackage]);
    }
}
