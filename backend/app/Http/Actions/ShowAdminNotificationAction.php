<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Controllers\Controller;
use App\Models\Osirase;
use App\Models\OsiraseGenre;
use App\Models\Releasenote;
use App\Models\ReleasenoteGenre;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class ShowAdminNotificationAction extends Controller
{
    public function __invoke(): View|Factory
    {
        //お知らせ
        $osirases = Osirase::orderBy('date', 'desc')->get();
        $osiraseGenres = OsiraseGenre::get(['id', 'name']);
        foreach ($osirases as $osirase) {
            //ジャンルidから名前取得
            $osirase->genre = $osiraseGenres[$osirase->genre_id - 1]->name;
        }

        //リリースノート
        $releasenotes = Releasenote::orderBy('date', 'desc')->get();
        $releasenoteGenres = ReleasenoteGenre::get(['id', 'name']);
        foreach ($releasenotes as $releasenote) {
            //ジャンルidから名前取得
            $releasenote->genre = $releasenoteGenres[$releasenote->genre_id - 1]->name;
        }

        return view('admin/notificationAdmin', ['osirases' => $osirases, 'osiraseGenres' => $osiraseGenres, 'releasenoteGenres' => $releasenoteGenres, 'releasenotes' => $releasenotes,]);
    }
}