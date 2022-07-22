<?php

declare(strict_types=1);

namespace App\Http\Actions\ReleaseNote;

use App\Http\Controllers\Controller;
use App\Models\Releasenote;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class ShowReleaseNoteAction extends Controller
{
    public function __invoke():View|Factory
    {
        $releasenotes = Releasenote::with('Releasenote_genre:id,name')->orderBy('date', 'desc')->get(['title', 'date', 'genre_id', 'description']);
        return view('diaryNoLogIn/releasenote', ['releasenotes' => $releasenotes,]);
    }
}
