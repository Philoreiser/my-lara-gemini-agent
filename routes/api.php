<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\QuickAskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Quick Ask Gemini a question
Route::post('/QuickAsk', QuickAskController::class);

Route::post('/QuickAsk/Chat', [QuickAskController::class, 'chat']);
