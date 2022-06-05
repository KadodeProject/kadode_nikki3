<?php

declare(strict_types=1);

namespace App\Http\Controllers\admin\packages;

use App\Http\Controllers\Controller;
use App\Models\NlpPackageGenre;
use App\Models\NlpPackageName;
use App\UseCases\NERLabel\GetAllNERLabelInOptionTabFormat;

class ShowPackageAdminController extends Controller
{
    public function __construct(
        private GetAllNERLabelInOptionTabFormat $getAllNERLabelInOptionTabFormat
    ) {
    }
    public function __invoke()
    {
        //パッケージ表示(最近更新のあったものから取り出す)
        $nlpPackageName = NlpPackageName::withoutGlobalScopes()->orderBy('updated_at', 'desc')->get();
        //パッケージジャンル表示
        $nlpPackageGenre = NlpPackageGenre::get();

        return view('admin/packages/index', ['nlpPackageName' => $nlpPackageName, 'nlpPackageGenre' => $nlpPackageGenre,]);
    }
}