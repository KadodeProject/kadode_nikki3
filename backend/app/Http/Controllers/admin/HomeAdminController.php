<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;


class HomeAdminController extends Controller
{
    public function __invoke()
    {
        return view('admin/homeAdmin');
    }

}