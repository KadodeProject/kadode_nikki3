<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Diary\UpdateDiaryRequest;
use App\Models\Diary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

final class UpdateDiaryAction extends Controller
{
    public function __invoke(UpdateDiaryRequest $request): Redirector|RedirectResponse
    {
        $updateContent = [
            "title" => $request->title,
            "content" => $request->content,
            "date" => $request->date,
        ];
        Diary::where('id', $request->id)->update($updateContent);
        return redirect(route('ShowHome'));
    }
}
