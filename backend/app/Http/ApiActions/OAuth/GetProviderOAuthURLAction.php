<?php

declare(strict_types=1);

namespace App\Http\ApiActions\OAuth;

use App\Http\Controllers\Controller;
use App\Http\Responder\OAuthResponder;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

final class GetProviderOAuthURLAction extends Controller
{
  // private $domain;
  // private $responder;

  // public function __construct()
  // {

  // }

  /**
   * Undocumented function
   *
   * @param string $provider 認証プロバイダーとなるサービス名
   */
  public function __invoke(string $provider): \Illuminate\Http\JsonResponse
  {
    assert(in_array($provider, ['google', 'github']));
    $redirectUrl = Socialite::driver($provider)->redirect()->getTargetUrl();

    return response()->json([
      'redirect_url' => $redirectUrl,
    ]);
  }
}
