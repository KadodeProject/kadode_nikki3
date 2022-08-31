<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

final class CreateDiaryAction extends Controller
{

    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        $request->date = $request->date ?? Carbon::today()->format("y-m-d");

        // バリデーション
        $this->validate($request, Diary::$rules);

        $form = [
            "user_id" => Auth::id(),
            "title" => $request->title,
            "content" => $request->content,
            "date" => $request->date,
            "uuid" => Str::uuid(),
        ];

        Diary::create($form);
        // ここで統計用テーブル作成するのもありだが、後方互換を保つためにはできないたいめ、生成時になかったら作る方式を採用している
        return redirect(route('ShowHome'));
    }
}