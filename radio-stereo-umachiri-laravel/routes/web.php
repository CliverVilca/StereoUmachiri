<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\NewsController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Ruta pública para detalle de noticia
Route::get('/noticias/{id}', [NewsController::class, 'detalle'])->name('noticias.detalle');

// Ruta pública para ver noticia
use Illuminate\Http\Request;

Route::match(['get', 'post'], '/news/{id}', function($id, Request $request) {
    $news = \App\Models\News::findOrFail($id);
    $comments = $news->comments()->where('approved', true)->orderBy('created_at', 'desc')->get();

    if ($request->isMethod('post')) {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'content' => 'required|string|max:500',
        ]);
        $comment = $news->comments()->create([
            'name' => $validated['name'],
            'content' => $validated['content'],
            'approved' => false,
        ]);

        // Notificar por email al administrador
        $adminEmail = env('ADMIN_EMAIL', 'admin@radiostereoumachiri.com');
        \Mail::to($adminEmail)->send(new \App\Mail\NewCommentNotification($comment, $news));

        return redirect()->route('news.show', $news->id)->with('success', 'Comentario enviado. Será visible tras aprobación.');
    }

    return view('news.show', compact('news', 'comments'));
})->name('news.show');

// Rutas del Panel de Administración
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/programs', [AdminController::class, 'programs'])->name('admin.programs');
    Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');

    // CRUD de noticias
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class);

    // Gestión de comentarios
    Route::get('comments', [App\Http\Controllers\Admin\CommentController::class, 'index'])->name('admin.comments.index');
    Route::post('comments/{id}/approve', [App\Http\Controllers\Admin\CommentController::class, 'approve'])->name('admin.comments.approve');
    Route::delete('comments/{id}', [App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('admin.comments.destroy');
});
