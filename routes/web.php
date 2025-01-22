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
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminTicketController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/tickets/{id}/update', [AdminTicketController::class, 'updateStatus'])->name('admin.tickets.update');
    // Route::delete('/admin/tickets/{id}/delete', [AdminTicketController::class, 'destroy'])->name('admin.tickets.delete');
    Route::delete('/admin/tickets/{id}', [AdminTicketController::class, 'destroy'])->name('admin.tickets.delete');
    Route::get('/admin/tickets/export', [AdminTicketController::class, 'exportToPdf'])->name('admin.tickets.export');
});

// User Dashboard
Route::middleware(['auth', 'user'])->group(function () {
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

// IT Requirements Pages
Route::middleware(['auth', UserMiddleware::class])->group(function () {
    Route::get('/software/list', [SoftwareController::class, 'list'])->name('software.list');
    Route::get('/troubleshooting', [TroubleshootingController::class, 'index'])->name('troubleshooting');
});

// Monitoring routes
Route::middleware(['auth'])->group(function () {
    Route::get('/user/tickets', [TicketController::class, 'monitoring'])->name('user.tickets.monitoring');
    Route::get('/user/tickets/{id}', [TicketController::class, 'show'])->name('user.tickets.show');
    Route::get('/software/monitoring', [SoftwareController::class, 'monitoring'])->name('software.monitoring');
    Route::get('/hardware/monitoring', [HardwareController::class, 'monitoring'])->name('hardware.monitoring');
});

// Work Order List
Route::middleware(['auth'])->group(function () {
    Route::get('/work-order-list', [TicketController::class, 'workOrderList'])->name('work_order.list');
});

// // Delete routes for User and Admin
// Route::middleware(['auth', 'user'])->group(function () {
//     Route::delete('/user/tickets/{id}', [TicketController::class, 'destroy'])->name('user.tickets.delete');
// });


// Troubleshooting routes for User and Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/user/troubleshooting', [TroubleshootingController::class, 'index'])->name('user.troubleshooting');
    Route::get('/user/troubleshooting/{id}', [TroubleshootingController::class, 'show'])->name('user.troubleshooting.show');

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/troubleshooting', [TroubleshootingController::class, 'adminIndex'])->name('admin.troubleshooting');
        Route::post('/admin/troubleshooting/{id}/respond', [TroubleshootingController::class, 'respond'])->name('admin.troubleshooting.respond');
    });
});
