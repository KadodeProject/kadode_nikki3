<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShowDiaryController extends Controller
{
    public function __invoke($month,$year)
    {
        // Carbon::
        $diaries=Diary::first();

        return view('diary/monthArchive',['diaries' => $diaries,]);
    }
}