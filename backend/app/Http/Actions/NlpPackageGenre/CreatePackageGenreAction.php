<?php

declare(strict_types=1);

namespace App\Http\Actions\NlpPackageGenre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use App\Models\NlpPackageGenre;

final class CreatePackageGenreAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        // バリデーション
        $this->validate($request, NlpPackageGenre::$rules);

        //中身作成
        $form = [
            "description" => $request->description,
            "name" => $request->name,
        ];

        NlpPackageGenre::create($form);
        return redirect('administrator/package#packageGenreTable');
    }
}
