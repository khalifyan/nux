<?php


use App\Http\Controllers\Api\LinkController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WinController;
use App\Http\Middleware\ValidateUniqueLink;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);

Route::middleware([ValidateUniqueLink::class])->group(function () {
    Route::prefix('link')
        ->as('link.')
        ->group(function () {
            Route::post('/{link}/view', [LinkController::class, 'view']);
            Route::post('/{link}/generate', [LinkController::class, 'generate']);
            Route::post('/{link}/deactivate', [LinkController::class, 'deactivate']);
        });

    Route::prefix('win')
        ->as('win.')
        ->group(function () {
            Route::post('/{link}/lucky', [WinController::class, 'lucky']);
            Route::post('/{link}/history', [WinController::class, 'history']);
        });
});


