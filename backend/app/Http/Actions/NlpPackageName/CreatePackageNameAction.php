<?php

declare(strict_types=1);

namespace App\Http\Actions\NlpPackageName;

use App\Http\Controllers\Controller;
use App\Models\NlpPackageName;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

final class CreatePackageNameAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        // バリデーション
        $this->validate($request, NlpPackageName::$rules);

        // 中身作成
        $form = [
            'user_id'     => Auth::id(),
            'genre_id'    => $request->NlpPackageGenre_id,
            'name'        => $request->name,
            'description' => $request->description,
            'is_publish'  => $request->is_publish,
        ];

        NlpPackageName::create($form);

        return redirect(route('ShowAdminPackage'));
    }
}
