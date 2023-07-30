<?php

declare(strict_types=1);

namespace App\Http\Actions\NlpPackageGenre;

use App\Http\Controllers\Controller;
use App\Models\NlpPackageGenre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class UpdatePackageGenreAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        // 日付のバリデーション→既に存在する日付ならエラー返す
        // バリデーション
        $this->validate($request, NlpPackageGenre::$rules);

        $updateContent = [
            'description' => $request->description,
            'name'        => $request->name,
        ];

        NlpPackageGenre::where('id', $request->NlpPackageGenre_id)->update($updateContent);

        return redirect(route('ShowAdminPackage').'#packageGenreTable');
    }
}
