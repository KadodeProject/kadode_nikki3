<?php

declare(strict_types=1);

namespace App\Http\ApiActions\Osirase;

use App\Http\Controllers\Controller;
use App\Models\Osirase;
use App\OpenApi\Responses\Osirase\OsiraseResponse;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
final class GetLatestOsiraseAction extends Controller
{
    /**
     * 直近5件のお知らせを取得
     */
    #[OpenApi\Operation()]
    #[OpenApi\Response(OsiraseResponse::class)]
    public function __invoke(): JsonResponse
    {
        /** @todo お知らせの個別ページがないので、現状お知らせ一覧をリンク先にしているため、個別ページできたら差し替え */
        $url = route('ShowOsirase');
        $osirases = Osirase::orderBy('date', 'desc')->limit(5)->get(['title', 'date', 'description']);

        return response()->json(
            // osirasesとurlを合体させる
            array_map(function ($osirase) use ($url) {
                $osirase['url'] = $url;

                return $osirase;
            }, $osirases->toArray())
        );
    }
}
