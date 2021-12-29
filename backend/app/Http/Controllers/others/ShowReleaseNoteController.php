<?php

namespace App\Http\Controllers\others;

use App\Http\Controllers\Controller;
use App\Models\Releasenote_genre;
use App\Models\Releasenote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShowReleaseNoteController extends Controller
{
    public function __invoke()
    {
        $releasenotes=Releasenote::orderBy('date', 'desc')->get(['title','date','genre_id','description']);
        $releasenoteGenres=Releasenote_genre::get(['id','name']);
        foreach($releasenotes as $releasenote){
            $releasenote->genre=$releasenoteGenres[$releasenote->genre_id-1]->name;
        }
        return view('diaryNoLogIn/releaseNote',['releasenotes' => $releasenotes,]);
    }
}