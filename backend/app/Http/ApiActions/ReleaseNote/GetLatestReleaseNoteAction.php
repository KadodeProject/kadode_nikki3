<?php

declare(strict_types=1);

namespace App\Http\ApiActions\ReleaseNote;

use App\Http\Controllers\Controller;
use App\Models\Releasenote;
use App\OpenApi\Responses\ReleaseNote\ReleaseNoteResponse;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
final class GetLatestReleaseNoteAction extends Controller
{
    /**
     * 直近5件のリリースノートを取得
     */
    #[OpenApi\Operation()]
    #[OpenApi\Response(ReleaseNoteResponse::class)]
    public function __invoke(): JsonResponse
    {
        /** @todo リリースノートの個別ページがないので、現状リリースノート一覧をリンク先にしているため、個別ページできたら差し替え */
        $url = route('ShowReleaseNote');
        $releaseNotes = Releasenote::orderBy('date', 'desc')->limit(5)->get(['title', 'date', 'description']);

        return response()->json(
            // osirasesとurlを合体させる
            array_map(function ($releaseNote) use ($url) {
                $releaseNote['url'] = $url;

                return $releaseNote;
            }, $releaseNotes->toArray())
        );
    }
}
