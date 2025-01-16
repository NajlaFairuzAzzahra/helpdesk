<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;



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

Route::middleware('auth')->group(function () {
    // Dashboard User
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // Ticket Forms
    Route::get('/ticket/software', function () {
        return view('ticket.software_form');
    })->name('ticket.software.form');

    Route::get('/ticket/hardware', function () {
        return view('ticket.hardware_form');
    })->name('ticket.hardware.form');

    // Form Submission
    Route::post('/ticket/software', [App\Http\Controllers\TicketController::class, 'submitSoftware'])->name('ticket.software.submit');
    Route::post('/ticket/hardware', [App\Http\Controllers\TicketController::class, 'submitHardware'])->name('ticket.hardware.submit');
});


Route::get('/software-form', [TicketController::class, 'showSoftwareForm'])->name('ticket.software.form');
Route::post('/software-form', [TicketController::class, 'submitSoftwareTicket'])->name('ticket.software.submit');
Route::get('/get-sub-systems', [App\Http\Controllers\TicketController::class, 'getSubSystems'])->name('get.subsystems');

Route::get('/hardware-form', [TicketController::class, 'showHardwareForm'])->name('ticket.hardware.form');
Route::post('/hardware-form', [TicketController::class, 'submitHardwareTicket'])->name('ticket.hardware.submit');
Route::get('/get-hardware-sub-systems', [TicketController::class, 'getHardwareSubSystems']);
Route::get('/get-hardwares', [TicketController::class, 'getHardwares']);
Route::get('/hardware/form', [TicketController::class, 'showHardwareForm'])->name('ticket.hardware.form');
Route::post('/hardware/submit', [TicketController::class, 'submitHardwareTicket'])->name('ticket.hardware.submit');



// Auth routes (Breeze)
require __DIR__.'/auth.php';
Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->name('login');
Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
