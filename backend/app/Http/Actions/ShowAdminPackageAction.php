<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Controllers\Controller;
use App\Models\NlpPackageGenre;
use App\Models\NlpPackageName;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class ShowAdminPackageAction extends Controller
{
    public function __invoke(): View|Factory
    {
        //パッケージ表示(最近更新のあったものから取り出す)
        $nlpPackageName = NlpPackageName::withoutGlobalScopes()->orderBy('updated_at', 'desc')->get();
        //パッケージジャンル表示
        $nlpPackageGenre = NlpPackageGenre::get();

        return view('admin/packages/index', ['nlpPackageName' => $nlpPackageName, 'nlpPackageGenre' => $nlpPackageGenre,]);
    }
}
