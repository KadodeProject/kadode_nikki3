<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function testRegistrationScreenCanBeRendered()
    {
        if (!Features::enabled(Features::registration())) {
            return static::markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testRegistrationScreenCannotBeRenderedIfSupportIsDisabled()
    {
        if (Features::enabled(Features::registration())) {
            return static::markTestSkipped('Registration support is enabled.');
        }

        $response = $this->get('/register');

        $response->assertStatus(404);
    }

    public function testNewUsersCanRegister()
    {
        if (!Features::enabled(Features::registration())) {
            return static::markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'Test1234',
            'password_confirmation' => 'Test1234',
            'terms' => true,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
