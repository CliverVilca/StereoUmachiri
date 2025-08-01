<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Rutas del Panel de Administración
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/programs', [AdminController::class, 'programs'])->name('admin.programs');
    Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
});
