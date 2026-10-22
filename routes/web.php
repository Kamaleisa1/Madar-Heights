<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\SiteController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

// Arabic at "/", English at "/en" (route names prefixed with "en.")
foreach (['ar' => '', 'en' => 'en'] as $locale => $prefix) {
    Route::prefix($prefix)
        ->name($locale === 'ar' ? '' : 'en.')
        ->middleware(SetLocale::class.':'.$locale)
        ->group(function () {
            Route::get('/', [SiteController::class, 'home'])->name('home');
            Route::get('/services', [SiteController::class, 'services'])->name('services');
            Route::get('/services/{slug}', [SiteController::class, 'service'])->name('service');
            Route::get('/areas/{slug}', [SiteController::class, 'area'])->name('area');
            Route::get('/about', [SiteController::class, 'about'])->name('about');
            Route::get('/blog', [SiteController::class, 'blog'])->name('blog');
            Route::get('/blog/{slug}', [SiteController::class, 'post'])->name('post');
            Route::get('/contact', [SiteController::class, 'contact'])->name('contact');

            Route::post('/booking', [BookingController::class, 'store'])
                ->middleware('throttle:10,1')
                ->name('booking');
        });
}

Route::get('/sitemap.xml', [SiteController::class, 'sitemap'])->name('sitemap');

// Web installer / database updater (no SSH needed on shared hosting)
Route::get('/install', [InstallController::class, 'show']);
Route::post('/install', [InstallController::class, 'setup'])->middleware('throttle:10,1');
Route::post('/install/update', [InstallController::class, 'update'])->middleware('throttle:10,1');
