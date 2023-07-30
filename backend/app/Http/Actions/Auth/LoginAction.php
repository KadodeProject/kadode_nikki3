<?php

declare(strict_types=1);

namespace App\Http\Actions\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;

final class LoginAction extends Controller
{
    public function __construct(
        private readonly AuthManager $auth,
    ) {
    }

    /**
     * @throws AuthenticationException
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        if ($this->auth->guard()->attempt($credentials)) {
            $request->session()->regenerate();

            $user = $this->auth->user();

            if ($user !== null) {
                return new JsonResponse([
                    'message' => 'Authenticated.',
                    'id'      => $user->id,
                    'name'    => $user->name,
                ]);
            }
        }

        throw new AuthenticationException();
    }
}
