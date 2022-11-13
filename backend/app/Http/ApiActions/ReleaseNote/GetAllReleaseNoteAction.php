<?php

declare(strict_types=1);

namespace App\Http\ApiActions\ReleaseNote;

use App\Http\Controllers\Controller;
use App\Models\Releasenote;
use Illuminate\Http\JsonResponse;

final class GetAllReleaseNoteAction extends Controller
{
    public function __invoke(): JsonResponse
    {
        /** @todo リリースノートの個別ページがないので、現状お知らせ一覧をリンク先にしているため、個別ページできたら差し替え */
        $url = route('ShowReleaseNote');
        $releaseNotes = Releasenote::orderBy('date', 'desc')->get(['title', 'date', 'description']);

        return response()->json(
            // osirasesとurlを合体させる
            array_map(function ($releaseNote) use ($url) {
                $releaseNote['url'] = $url;

                return $releaseNote;
            }, $releaseNotes->toArray())
        );
    }
}
