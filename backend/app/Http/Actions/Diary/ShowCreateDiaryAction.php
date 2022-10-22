<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class ShowCreateDiaryAction extends Controller
{
    public function __invoke(): View|Factory
    {
        return view('diary/newDiary');
    }
}
