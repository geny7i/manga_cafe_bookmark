<?php

use App\Http\Controllers\Api\ExtComicController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/ext_comic/bulk_match', [ExtComicController::class, 'bulk_match']);
    Route::post('/ext_comic', [ExtComicController::class, 'create']);
});
