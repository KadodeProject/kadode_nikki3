<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Osirase;
use App\Models\Osirase_genre;
use App\Models\Releasenote;
use App\Models\Releasenote_genre;
use Illuminate\Http\Request;

class NotificationBroadcasterAdminController extends Controller
{
    public function __invoke()
    {
        //お知らせ
        $osirases=Osirase::orderBy('date', 'desc')->get();
        $osiraseGenres=Osirase_genre::get(['id','name']);
        foreach($osirases as $osirase){
            //ジャンルidから名前取得
            $osirase->genre=$osiraseGenres[$osirase->genre_id-1]->name;
        }

        //リリースノート
        $releasenotes=Releasenote::orderBy('date', 'desc')->get();
        $releasenoteGenres=Releasenote_genre::get(['id','name']);
        foreach($releasenotes as $releasenote){
            //ジャンルidから名前取得
            $releasenote->genre=$releasenoteGenres[$releasenote->genre_id-1]->name;
        }

        return view('admin/notificationAdmin',['osirases' => $osirases,'osiraseGenres'=>$osiraseGenres,'releasenoteGenres'=>$releasenoteGenres,'releasenotes' => $releasenotes,]);
    }

}