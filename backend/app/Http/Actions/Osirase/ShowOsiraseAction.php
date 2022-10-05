<?php

declare(strict_types=1);

namespace App\Http\Actions\Osirase;

use App\Http\Controllers\Controller;
use App\Models\Osirase;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class ShowOsiraseAction extends Controller
{
    public function __invoke(Request $request): View|Factory
    {
        $osirases = Osirase::with('OsiraseGenre:id,name')->orderBy('date', 'desc')->get(['title', 'date', 'genre_id', 'description']);
        return view('diaryNoLogIn/osirase', ['osirases' => $osirases,]);
    }
}
