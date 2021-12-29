<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\NERLabel;
use App\Models\NlpPackageGenre;
use App\Models\NlpPackageName;
use App\Models\PackageNER;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    public function __invoke()
    {
        return view('diary.admin.homeAdmin');
    }

}