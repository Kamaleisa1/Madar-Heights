<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InstallTest extends TestCase
{
    use RefreshDatabase;

    public function test_installer_is_hidden_without_a_setup_key(): void
    {
        config(['app.install_key' => null]);
        $this->get('/install')->assertNotFound();

        config(['app.install_key' => 'CHANGE_ME_setup_key']);
        $this->get('/install')->assertNotFound();
    }

    public function test_installer_creates_content_and_first_admin(): void
    {
        config(['app.install_key' => 'secret-key-123']);
        $this->get('/install')->assertOk()->assertSee('تركيب لوحة التحكم');

        $this->withoutMiddleware(ValidateCsrfToken::class)->post('/install', [
            'key' => 'secret-key-123', 'name' => 'Owner', 'email' => 'owner@example.com',
            'password' => 'long-password-1', 'password_confirmation' => 'long-password-1',
        ])->assertRedirect('/admin/login');

        $this->assertSame(1, User::count());
        $this->assertSame(13, Service::count());

        // locked once an admin exists
        $this->get('/install')->assertNotFound();
        $this->withoutMiddleware(ValidateCsrfToken::class)->post('/install', [
            'key' => 'secret-key-123', 'name' => 'X', 'email' => 'x@example.com',
            'password' => 'long-password-1', 'password_confirmation' => 'long-password-1',
        ])->assertNotFound();
        $this->assertSame(1, User::count());
    }

    public function test_wrong_key_is_rejected(): void
    {
        config(['app.install_key' => 'secret-key-123']);

        $this->withoutMiddleware(ValidateCsrfToken::class)->post('/install', [
            'key' => 'wrong', 'name' => 'Owner', 'email' => 'owner@example.com',
            'password' => 'long-password-1', 'password_confirmation' => 'long-password-1',
        ])->assertSessionHasErrors('key');

        $this->assertSame(0, User::count());
    }

    public function test_logged_in_admin_can_run_database_update(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get('/install')->assertOk()->assertSee('تحديث قاعدة البيانات');
        $this->actingAs($user)->withoutMiddleware(ValidateCsrfToken::class)->post('/install/update')->assertRedirect('/install');
        $this->assertSame(13, Service::count());
    }
}
