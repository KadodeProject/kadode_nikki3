<?php

declare(strict_types=1);

namespace App\Http\Actions\PackageNER;

use App\Http\Controllers\Controller;
use App\Models\PackageNER;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

final class CreatePNERAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
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
}
