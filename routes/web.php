<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\FileUploadController;
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

// Ticket routes
Route::middleware('auth')->group(function () {
    // Software Ticket
    Route::get('/ticket/software', [TicketController::class, 'showSoftwareForm'])->name('ticket.software.form');
    Route::post('/ticket/software', [TicketController::class, 'submitSoftwareTicket'])->name('ticket.software.submit');
    Route::get('/get-sub-systems', [TicketController::class, 'getSubSystems'])->name('get.subsystems');

    // Hardware Ticket
    Route::get('/ticket/hardware', [TicketController::class, 'showHardwareForm'])->name('ticket.hardware.form');
    Route::post('/ticket/hardware', [TicketController::class, 'submitHardwareTicket'])->name('ticket.hardware.submit');
    Route::get('/get-hardwares', [TicketController::class, 'getHardwares'])->name('get.hardwares');
});

// CKEditor upload route
Route::post('/ckeditor/upload', [FileUploadController::class, 'upload'])->name('ckeditor.upload');

// Auth routes (Breeze)
require __DIR__ . '/auth.php';
Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
