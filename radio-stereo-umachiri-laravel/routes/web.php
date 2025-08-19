<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Public news routes
Route::get('/noticias', [NewsController::class, 'index'])->name('noticias.index');
Route::get('/noticias/{id}', [NewsController::class, 'show'])->name('noticias.show');
Route::post('/noticias/{id}/comments', [NewsController::class, 'storeComment'])->name('noticias.comments.store');
// Public sports routes
Route::get('/deportes', [SportController::class, 'index'])->name('sports.index');
Route::get('/deportes/{id}', [SportController::class, 'show'])->name('sports.show');

// Public programs route
Route::get('/programacion', [ProgramController::class, 'index'])->name('programs.index');

// Public events route
Route::get('/eventos', [App\Http\Controllers\EventController::class, 'index'])->name('events.index');

// Public gallery route
Route::get('/galeria', [App\Http\Controllers\GalleryController::class, 'index'])->name('galleries.index');

// Public podcasts for a program
Route::get('/programacion/{program}/podcasts', [App\Http\Controllers\ProgramController::class, 'podcasts'])->name('programs.podcasts');

// Admin Panel Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');

    // News CRUD
    Route::resource('noticias', App\Http\Controllers\Admin\NewsController::class)->names('admin.noticias');

    // Sports CRUD
    Route::resource('sports', App\Http\Controllers\Admin\SportController::class)->names('admin.sports');

    // Programs CRUD
    Route::resource('programs', App\Http\Controllers\Admin\ProgramController::class)->names('admin.programs');

    // Events CRUD
    Route::resource('events', App\Http\Controllers\Admin\EventController::class)->names('admin.events');

    // Galleries CRUD
    Route::resource('galleries', App\Http\Controllers\Admin\GalleryController::class)->names('admin.galleries');

    // Podcasts CRUD (nested under programs)
    Route::resource('programs.podcasts', App\Http\Controllers\Admin\PodcastController::class)->except(['show'])->names('admin.programs.podcasts');

    // DJs CRUD
    Route::resource('djs', App\Http\Controllers\Admin\DjController::class)->names('admin.djs');

    // Comment Management
    Route::get('comments', [App\Http\Controllers\Admin\CommentController::class, 'index'])->name('admin.comments.index');
    Route::post('comments/{id}/approve', [App\Http\Controllers\Admin\CommentController::class, 'approve'])->name('admin.comments.approve');
    Route::delete('comments/{id}', [App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('admin.comments.destroy');
});
