<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\Auth\AuthApiController;
use App\Http\Controllers\Api\PermissionUserController;


Route::get('/me', [AuthApiController::class, 'me'])->name('auth.me')->middleware('auth:sanctum');
Route::post('/logout', [AuthApiController::class, 'logout'])->name('auth.logout')->middleware('auth:sanctum');
Route::post('/auth', [AuthApiController::class, 'auth'])->name('auth');

Route::middleware(['auth:sanctum', 'acl'])->group(function () {
    Route::apiResource('permissions', PermissionController::class);

    Route::get('/users/{id}/permissions', [PermissionUserController::class, 'getPermissionsOfUser'])->name('users.permissions');
    Route::post('/users/{id}/permissions-sync', [PermissionUserController::class, 'syncPermissionsOfUser'])->name('users.permissions.sync');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});
