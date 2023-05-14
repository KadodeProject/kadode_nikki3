<?php

declare(strict_types=1);

namespace App\Http\ApiActions\OAuth;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

final class HandleProviderCallbackAction extends Controller
{
  /**
   * ソーシャルログイン処理
   * @return App\User
   */
  public function __invoke()
  {
    $googleUser = Socialite::driver('google')->ser();

    $user  = User::where('google_id', $googleUser->id)->first();
    $token = Str::random(80);

    if ($user) {
      $user->update([
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'email_verified_at' => now(),
        'profile_photo_path' => $googleUser->avatar,
        'login_provider' => 1,
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
        'api_token' => hash('sha256', $token),
      ]);
    } else {
      $user = User::create([
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'email_verified_at' => now(),
        'profile_photo_path' => $googleUser->avatar,
        'login_provider' => 1,
        'google_id' => $googleUser->id,
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
        'api_token' => hash('sha256', $token),
      ]);
    }

    Auth::login($user);

    $cookie = cookie('api_token', $token, '10000000', null, null, null, false);
    return redirect(env('FRONTEND_URL') . '/home')->cookie($cookie);
  }
}
