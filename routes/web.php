<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/services', [SiteController::class, 'services'])->name('services');
Route::get('/services/{slug}', [SiteController::class, 'service'])->name('service');
Route::get('/areas/{slug}', [SiteController::class, 'area'])->name('area');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [SiteController::class, 'post'])->name('post');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::get('/sitemap.xml', [SiteController::class, 'sitemap'])->name('sitemap');

Route::post('/booking', [BookingController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('booking');
