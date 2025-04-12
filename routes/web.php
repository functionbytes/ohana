<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ValidationController;
use App\Http\Controllers\Pages\ChatbotController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Pages\PagesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::group(['middleware' => ['web']], function () {

    Route::get('/', [LoginController::class, 'showLoginForm'])->name('index');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
    Route::get('/home', [PagesController::class, 'home'])->name('home');

    Route::get('/clear', function () {
        Artisan::call('dump-autoload');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        return '<h1>Cache Borrado</h1>';
    });

    Route::group(['prefix' => 'password'], function () {
        Route::get('/confirm', [ForgotPasswordController::class, 'showLinkRequest'])->name('password.confirm');
        Route::get('/reset', [ForgotPasswordController::class, 'showLinkRequest'])->name('password.reset');
        Route::post('/reset', [ResetPasswordController::class, 'reset']);
        Route::post('/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/reset/{slack}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.token');
    });

});


