<?php

declare(strict_types=1);

namespace App\Http\Actions\Diary\Search;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use function view;

class ShowSimpleSearchAction extends Controller
{
    public function __invoke():View|Factory
    {
        return view('diary/search/searchResult');
    }
}
