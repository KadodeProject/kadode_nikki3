<?php

declare(strict_types=1);

namespace App\Http\Actions\CustomNER;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomNER;

class UpdateCNERAction extends Controller
{
    public function __invoke(Request $request):Redirector|RedirectResponse
    {
        // 日付のバリデーション→既に存在する日付ならエラー返す
        // バリデーション
        $this->validate($request, CustomNER::$rules);

        $updateContent = [
            "label_id" => $request->label_id,
            "name" => $request->name,
        ];

        CustomNER::where('id', $request->customNER_id)->update($updateContent);
        return redirect('statistics/settings#customNERTable');
    }
}
