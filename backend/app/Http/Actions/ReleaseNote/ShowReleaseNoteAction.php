<?php

declare(strict_types=1);

namespace App\Http\Actions\ReleaseNote;

use App\Http\Controllers\Controller;
use App\Models\Releasenote;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class ShowReleaseNoteAction extends Controller
{
    public function __invoke(): View|Factory
    {
        /** @todo ジャンル名の呼び出しがwith使ってるけど、内部的にはループでwith呼び出されている雰囲気なので修正した */
        $releasenotes = Releasenote::with('Releasenote_genre:id,name')->orderBy('date', 'desc')->get(['title', 'date', 'genre_id', 'description']);
        return view('diaryNoLogIn/releasenote', ['releasenotes' => $releasenotes,]);
    }
}