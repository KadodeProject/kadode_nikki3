<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class ShowContactAction extends Controller
{
    public function __invoke(): View|Factory
    {
        return view('diaryNoLogIn/contact');
    }
}