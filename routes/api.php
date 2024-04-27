<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;

Route::controller(AuthController::class)->group(function (){
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware(['auth:sanctum']);
});

Route::controller(ResetPasswordController::class)->group(function (){
    Route::post('/forgot-password', 'sendLinkResetPassword')->name('user.forgot-password');
    Route::post('/reset-password', 'resetPassword')->name('user.reset-password-from-mail');
    Route::post('/change-password', 'resetPassword')->name('user.reset-password')->middleware(['auth:sanctum']);
});

Route::controller(ProfileController::class)->middleware(['auth:sanctum'])->group(function (){
    Route::get('/get-profile', 'getProfile');
    Route::put('/update-profile', 'updateProfile');
});

Route::controller(PostController::class)->middleware(['auth:sanctum'])->group(function (){
    Route::post('/create-post', 'create');
    Route::put('/update-post/{post}', 'update');
    Route::patch('/share-post/{post}', 'sharePost');
    Route::patch('/hide-post/{post}', 'hidePost');
    Route::delete('/delete-post/{post}', 'destroy');
});






