<?php

use App\Http\Controllers\Api\ExtComicController;
use App\Http\Controllers\ApiKeyController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ShopController;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/auth/{provider}/redirect', [OAuthController::class, 'redirect'])->name('oauth.redirect');
Route::get('/auth/{provider}/callback', [OAuthController::class, 'callback'])->name('oauth.callback');

Route::get('/rejected', [SessionController::class, 'rejected'])->name('rejected');
Route::get('/rejected', [SessionController::class, 'rejected'])->name('login'); // alias

Route::middleware(['auth'])->group(function () {
    Route::resource('api_keys', ApikeyController::class, ['only' => ['index', 'store']]);

    Route::get('/', [ComicController::class, 'index'])->name('home');

    Route::resource('shops', ShopController::class, ['only' => ['index']]);

    Route::delete('/logout', [SessionController::class, 'logout'])
        ->name('logout');
});
