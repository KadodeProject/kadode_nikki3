<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * jetstreamデフォルトのlivewire使ってないのでこのテストは絶対に失敗する
     *
     * @return void
     */
    public function test_current_profile_information_is_available()
    {
        return $this->markTestSkipped('Livewireでは実装していないため省略');

        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(UpdateProfileInformationForm::class);

        $this->assertSame($user->name, $component->state['name']);
        $this->assertSame($user->email, $component->state['email']);
    }

    public function test_profile_information_can_be_updated()
    {
        return $this->markTestSkipped('Livewireでは実装していないため省略');

        $this->actingAs($user = User::factory()->create());

        Livewire::test(UpdateProfileInformationForm::class)
            ->set('state', ['name' => 'Test Name', 'email' => 'test@example.com'])
            ->call('updateProfileInformation');

        $this->assertSame('Test Name', $user->fresh()->name);
        $this->assertSame('test@example.com', $user->fresh()->email);
    }
}
