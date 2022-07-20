<?php

declare(strict_types=1);

namespace App\Http\Actions\Osirase;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Osirase;

final class ShowOsiraseAction extends Controller
{
    public function __invoke():View|Factory
    {
        $osirases = Osirase::with('Osirase_genre:id,name')->orderBy('date', 'desc')->get(['title', 'date', 'genre_id', 'description']);
        return view('diaryNoLogIn/osirase', ['osirases' => $osirases,]);
    }
}
