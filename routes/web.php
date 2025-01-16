<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;


// Public home page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Admin routes
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});


// User routes
Route::middleware(['auth', UserMiddleware::class])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});


//ticket routes
Route::middleware('auth')->group(function () {
    Route::get('/ticket', function () {
        return view('ticket.form');
    })->name('ticket.form');

    Route::post('/ticket', [App\Http\Controllers\TicketController::class, 'submit'])
        ->name('ticket.submit');
});


// Auth routes (Breeze)
require __DIR__.'/auth.php';
Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->name('login');
Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
