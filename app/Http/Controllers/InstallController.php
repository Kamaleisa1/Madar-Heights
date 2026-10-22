<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\SiteContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

/**
 * Web installer for shared hosting without SSH.
 *
 * - First run: needs INSTALL_KEY from .env, then creates the tables, copies the
 *   site content into the database and creates the first admin account.
 *   It locks itself as soon as an admin exists.
 * - Later: a logged-in admin can open it to apply database updates.
 */
class InstallController extends Controller
{
    public function show(): View
    {
        return match ($this->mode()) {
            'setup' => view('install', ['mode' => 'setup']),
            'update' => view('install', ['mode' => 'update']),
            default => abort(404),
        };
    }

    public function setup(Request $request): RedirectResponse
    {
        abort_unless($this->mode() === 'setup', 404);

        $data = $request->validate([
            'key' => ['required', 'string'],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'password' => ['required', 'string', 'min:10', 'confirmed'],
        ], [], [
            'key' => 'مفتاح التركيب', 'name' => 'الاسم', 'email' => 'الإيميل', 'password' => 'كلمة المرور',
        ]);

        if (! hash_equals((string) config('app.install_key'), $data['key'])) {
            return back()->withInput($request->except('password', 'password_confirmation', 'key'))
                ->withErrors(['key' => 'مفتاح التركيب غير صحيح. لازم يكون نفس اللي مكتوب في INSTALL_KEY في ملف .env']);
        }

        try {
            Artisan::call('migrate', ['--force' => true]);
            Artisan::call('db:seed', ['--force' => true]);
            User::create(['name' => $data['name'], 'email' => $data['email'], 'password' => $data['password']]);
            SiteContent::flush();
        } catch (Throwable $e) {
            report($e);

            return back()->withInput($request->except('password', 'password_confirmation', 'key'))
                ->withErrors(['db' => 'تعذر الاتصال بقاعدة البيانات. راجع DB_DATABASE و DB_USERNAME و DB_PASSWORD في ملف .env. ('.$e->getMessage().')']);
        }

        return redirect('/admin/login')->with('status', 'installed');
    }

    public function update(): RedirectResponse
    {
        abort_unless($this->mode() === 'update', 404);

        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);
        SiteContent::flush();

        return redirect('/install')->with('status', 'updated');
    }

    /** 'setup' before any admin exists, 'update' for a logged-in admin, otherwise null. */
    protected function mode(): ?string
    {
        try {
            $hasAdmin = Schema::hasTable('users') && User::query()->exists();
        } catch (Throwable) {
            $hasAdmin = false;
        }

        if (! $hasAdmin) {
            $key = (string) config('app.install_key');

            return ($key !== '' && ! str_starts_with($key, 'CHANGE_ME')) ? 'setup' : null;
        }

        return auth()->check() ? 'update' : null;
    }
}
