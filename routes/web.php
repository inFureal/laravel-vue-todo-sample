<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::view('app', 'front')
    ->middleware('auth');

Route::prefix('api')
->group(function () {

    Route::apiResource('todos', TodoController::class)
        ->middleware('auth')
        ->except('show');

});