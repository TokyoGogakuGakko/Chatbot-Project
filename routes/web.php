<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chat', function () {
    $selectedJobId = request()->get('jobId');

    return view('chat', compact('selectedJobId'));
})->name('chat');

Route::post('/chat', function (){
})->name('chat.store');
