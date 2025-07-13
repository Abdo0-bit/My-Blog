<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/',[PostController::class, 'index']);

Route::get('/dashboard', function () {
    $user = auth()->user();
    return view('dashboard', [
        'user' => $user,
        'posts_count' => $user->posts()->count(),
        'comments_count' => $user->comments()->count(),
        'latest_posts' => $user->posts()->latest()->take(3)->get(),
        'latest_comments' => $user->comments()->latest()->take(3)->with('post')->get(),
    ]);
})->middleware('auth')->name('dashboard');


Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
});
Route::resource('posts', \App\Http\Controllers\PostController::class);

Route::middleware('auth')->group(function () {
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/my-comments', [CommentController::class, 'userComments'])->name('comments.user');
});


require __DIR__.'/auth.php';
