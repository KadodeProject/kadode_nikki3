<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use InvalidArgumentException;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
public function boot(): void
{
    $this->registerPolicies();
    ResetPassword::createUrlUsing(function ($notifiable, $token) {
        if (!$notifiable instanceof \App\Models\User) {
            throw new InvalidArgumentException('Unexpected notifiable type.');
        }

        return config('app.frontend_url')."/password-reset/{$token}?email={$notifiable->getEmailForPasswordReset()}";
    });
}
}
