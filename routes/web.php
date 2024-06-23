<?php

use App\Http\Controllers\API\ChatController;
use App\Models\Conversation;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/chat/start', [ChatController::class, 'startInterview'])->name('chat.start');

Route::get('/chat', [ChatController::class, 'index'])->name('chat');

Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');

