<?php

namespace App\Http\Controllers\others;

use App\Http\Controllers\Controller;
use App\Models\Osirase_genre;
use App\Models\Osirase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShowNewsController extends Controller
{
    public function __invoke()
    {
        $osirases=Osirase::orderBy('date', 'desc')->get(['title','date','genre_id','description']);
        $osiraseGenres=Osirase_genre::get(['id','name']);
        foreach($osirases as $osirase){
            $osirase->genre=$osiraseGenres[$osirase->genre_id-1]->name;
        }
        return view('diaryNoLogIn/news',['osirases' => $osirases,]);
    }
}