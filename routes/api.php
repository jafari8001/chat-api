<?php

use App\Http\Controllers\Api\MessageController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/messages', [MessageController::class, 'store']);
    Route::get('/conversations/{id}/messages', [MessageController::class, 'index']);
});
