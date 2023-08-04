<?php

declare(strict_types=1);

namespace App\Http\ApiActions;

use App\Http\Controllers\Controller;
use App\OpenApi\Responses\GetApiStatusActionResponse;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
final class GetApiStatusAction extends Controller
{
    /**
     * ✌を返す
     */
    #[OpenApi\Operation()]
    #[OpenApi\Response(GetApiStatusActionResponse::class)]
    public function __invoke(): JsonResponse
    {
        return response()->json(
            ['status' => '✌']
        );
    }
}
