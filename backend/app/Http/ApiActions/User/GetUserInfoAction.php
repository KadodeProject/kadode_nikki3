<?php

declare(strict_types=1);

namespace App\Http\ApiActions\User;

use App\Http\Controllers\Controller;
use App\OpenApi\Responses\User\GetUserInfoActionResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
final class GetUserInfoAction extends Controller
{
    /**
     * ログイン中userの情報を取得
     */
    #[OpenApi\Operation()]
    #[OpenApi\Response(GetUserInfoActionResponse::class)]
    public function __invoke(): JsonResponse
    {
        $user = Auth::user();
        if ($user === null) {
            // 認証されていない場合の処理
            throw new AuthenticationException();
        }

        return response()->json(
            [
                'id'   => $user->id,
                'name' => $user->name,
            ]
        );
    }
}
