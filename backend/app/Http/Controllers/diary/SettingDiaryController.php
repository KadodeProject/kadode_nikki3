<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingDiaryController extends Controller
{
    public function __invoke()
    {
        return view('diary/setting');

    }

}