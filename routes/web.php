<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\FileUploadController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\UatController;
use App\Http\Controllers\HardwareController;
use App\Http\Controllers\TroubleshootingController;
use App\Http\Controllers\AdminTicketController;

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
    Route::post('/ticket/store', [TicketController::class, 'store'])->name('ticket.store');

    // Hardware Ticket
    Route::get('/ticket/hardware', [TicketController::class, 'showHardwareForm'])->name('ticket.hardware.form');
    Route::post('/ticket/hardware', [TicketController::class, 'submitHardwareTicket'])->name('ticket.hardware.submit');
    Route::get('/get-hardwares', [TicketController::class, 'getHardwares'])->name('get.hardwares');
    Route::post('/ticket/store', [TicketController::class, 'store'])->name('ticket.store');
});

// CKEditor upload route
Route::post('/ckeditor/upload', [FileUploadController::class, 'upload'])->name('ckeditor.upload');

// Auth routes (Breeze)
require __DIR__ . '/auth.php';
Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware(['auth', UserMiddleware::class])->group(function () {
    // IT Requirements Pages
    Route::get('/software/list', [SoftwareController::class, 'list'])->name('software.list');
    Route::get('/software/monitoring', [SoftwareController::class, 'monitoring'])->name('software.monitoring');
    Route::get('/hardware/monitoring', [HardwareController::class, 'monitoring'])->name('hardware.monitoring');
    Route::get('/troubleshooting', [TroubleshootingController::class, 'index'])->name('troubleshooting');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/tickets', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('ticket.store');
});

//monitoring
Route::middleware(['auth'])->group(function () {
Route::get('/user/tickets', [TicketController::class, 'monitoring'])->name('user.tickets.monitoring');
Route::get('/user/tickets/{id}', [TicketController::class, 'show'])->name('user.tickets.show');
});

//dashboard admin,
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
    Route::post('/admin/tickets/{id}/update', [AdminTicketController::class, 'update'])->name('admin.tickets.update');
});
