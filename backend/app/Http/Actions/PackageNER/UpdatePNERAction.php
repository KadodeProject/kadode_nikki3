<?php

declare(strict_types=1);

namespace App\Http\Actions\PackageNER;

use App\Http\Controllers\Controller;
use App\Models\PackageNER;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class UpdatePNERAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
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
}
