<?php

declare(strict_types=1);

namespace App\Http\ApiActions\Statistic;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use App\OpenApi\Responses\Statistic\StatisticResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
final class GetStatisticAction extends Controller
{
    /**
     * ログイン中userの情報を取得
     */
    #[OpenApi\Operation()]
    #[OpenApi\Response(StatisticResponse::class)]
    public function __invoke(): JsonResource
    {
        $statistic = Statistic::where('user_id', Auth::id())->first();

        return new JsonResource($statistic);
    }
}
