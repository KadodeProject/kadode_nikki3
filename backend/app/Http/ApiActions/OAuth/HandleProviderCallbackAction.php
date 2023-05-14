<?php

declare(strict_types=1);

namespace App\Http\ApiActions\OAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

final class HandleProviderCallbackAction extends Controller
{
    /**
     * ソーシャルログイン処理.
     *
     * @return App\User
     */
    public function __invoke(string $provider): Redirector
    {
        \assert(\in_array($provider, ['google', 'github'], true));
        $socialiteUser = Socialite::driver($provider)->ser();

        $user = User::where('social_auth_id', $socialiteUser->id)->first();
        $token = Str::random(80);

        if ($user) {
            $user->update([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'auth_type' => 1,
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
                'auth_type' => 1,
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

        return redirect(env('FRONTEND_URL').'/home')->cookie($cookie);
    }
}
