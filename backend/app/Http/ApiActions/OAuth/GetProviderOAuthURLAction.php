<?php

declare(strict_types=1);

namespace App\Http\ApiActions\OAuth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

use function assert;
use function in_array;

final class GetProviderOAuthURLAction extends Controller
{
    // private $domain;
    // private $responder;

    // public function __construct()
    // {

    // }

    /**
     * Undocumented function.
     *
     * @param string $provider 認証プロバイダーとなるサービス名
     */
    public function __invoke(string $provider): \Illuminate\Http\JsonResponse
    {
        assert(in_array($provider, ['google', 'github'], true));
        $redirectUrl = Socialite::driver($provider)->redirect()->getTargetUrl();

        return response()->json([
            'redirect_url' => $redirectUrl,
        ]);
    }
}
