<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class UpdateDiaryAction extends Controller
{
    public function __invoke(Request $request):Redirector|RedirectResponse
    {
        // 日付のバリデーション→既に存在する日付ならエラー返す
        // バリデーション
        $this->validate($request, Diary::$rules);

        $updateContent = [
            "title" => $request->title,
            "content" => $request->content,
            "date" => $request->date,
        ];
        Diary::where('uuid', $request->uuid)->update($updateContent);
        return redirect('home');
    }
}
