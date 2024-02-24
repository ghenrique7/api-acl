<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;


Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'index'])->name('users.index');

