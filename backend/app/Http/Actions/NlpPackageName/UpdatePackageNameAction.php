<?php

declare(strict_types=1);

namespace App\Http\Actions\NlpPackageName;

use App\Http\Controllers\Controller;
use App\Models\NlpPackageName;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class UpdatePackageNameAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
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
        return redirect(route('ShowAdminPackage'));
    }
}