<?php

namespace App\Http\Controllers\statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsStatisticsController extends Controller
{
    public function __invoke()
    {
        return view("diary/statistics/settingsStatistics");
    }
}