<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::controller(ResetPasswordController::class)->group(function (){
    Route::post('/forgot-password', 'sendLinkResetPassword')->name('user.forgot-password');
    Route::post('/new-password', 'resetPassword')->name('user.reset-password-from-mail');
    Route::post('/reset-password', 'resetPassword')->name('user.reset-password')->middleware(['auth:sanctum']);
});


