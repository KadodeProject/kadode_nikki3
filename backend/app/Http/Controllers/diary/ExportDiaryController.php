<?php

namespace App\Http\Controllers\diary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExportDiaryController extends Controller
{
    public function __invoke($request)
    {
        $user_id=Auth::id();
        
    }
}