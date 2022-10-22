<?php

declare(strict_types=1);

namespace App\Http\Actions\CustomNER;

use App\Http\Controllers\Controller;
use App\Models\CustomNER;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class CreateCNERAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        // バリデーション
        $this->validate($request, CustomNER::$rules);

        //中身作成
        $form = [
            "user_id" => Auth::id(),
            "label_id" => $request->label_id,
            "name" => $request->name,
        ];

        CustomNER::create($form);
        return redirect(route('ShowStatisticSetting') . '#customNERTable');
    }
}
