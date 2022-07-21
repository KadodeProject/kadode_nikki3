<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Diary;

final class DeleteDiaryAction extends Controller
{
    public function __invoke(Request $request):Redirector|RedirectResponse
    {
        Diary::where('uuid', $request->uuid)->delete();
        return redirect('home');
    }
}
