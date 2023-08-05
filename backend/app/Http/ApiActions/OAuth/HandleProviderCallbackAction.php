<?php

declare(strict_types=1);

namespace App\Http\ApiActions\OAuth;

use App\Enums\AuthType;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\OpenApi\Responses\OAuth\HandleProviderCallbackActionResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

use function assert;
use function in_array;

#[OpenApi\PathItem]
final class HandleProviderCallbackAction extends Controller
{
    /**
     * ソーシャルログイン処理
     */
    #[OpenApi\Operation()]
    #[OpenApi\Response(HandleProviderCallbackActionResponse::class)]
    public function __invoke(string $provider): Redirector|RedirectResponse
    {
        assert(in_array($provider, ['google', 'github'], true));

        /** @phpstan-ignore-next-line */
        $socialiteUser = Socialite::driver($provider)->stateless()->user(); // statelessが存在するのに存在しないエラーが出るのでPHPStanを黙らせている

        $user = User::where('oauth_id', $socialiteUser->id)->first();
        if (!$user) {
            if (!User::where('email', $socialiteUser->email)->first()) {
                // ユーザー居なかったら新規で登録
                $user = User::create([
                    'name'               => $socialiteUser->name,
                    'email'              => $socialiteUser->email,
                    'email_verified_at'  => now(),
                    'auth_type'          => $this->getAuthTypeIntFromName($provider),
                    'oauth_id'           => $socialiteUser->id,
                    'profile_photo_path' => $socialiteUser->avatar,
                ]);
            } else {
                // メールアドレスは既に存在しているので、別の認証で登録しているパターン
                return redirect(env('FRONTEND_URL').'/login?error=auth_type');
            }
        }

        Auth::login($user);

        return redirect(env('FRONTEND_URL').'/home');
    }

    /**
     * Enumがintで作っているので文字→数値の変換ができないので自前で用意する.
     */
    private function getAuthTypeIntFromName(string $name): int
    {
        $authTypes = AuthType::cases();
        $authTypeArray = [];
        foreach ($authTypes as $authType) {
            $authTypeArray[$authType->name] = $authType->value;
        }

        return $authTypeArray[$name];
    }
}
