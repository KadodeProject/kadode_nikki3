<?php

declare(strict_types=1);

namespace App\Http\ApiActions\Osirase;

use App\Http\Controllers\Controller;
use App\Models\Osirase;
use Illuminate\Http\JsonResponse;

final class GetAllOsiraseAction extends Controller
{
    public function __invoke(): JsonResponse
    {
        /** @todo お知らせの個別ページがないので、現状お知らせ一覧をリンク先にしているため、個別ページできたら差し替え */
        $url = route('ShowOsirase');
        $osirases = Osirase::orderBy('date', 'desc')->get(['title', 'date', 'description']);

        return response()->json(
            array_map(function ($osirase) use ($url) {
                $osirase['url'] = $url;

                return $osirase;
            }, $osirases->toArray())
        );
    }
}
