<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class DeleteDiaryAction extends Controller
{
    public function __invoke(Request $request): Redirector|RedirectResponse
    {
        Diary::where('id', $request->id)->delete();
        return redirect(route('ShowHome'));
    }
}