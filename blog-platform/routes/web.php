<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public blog routes
Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [PostController::class, 'show'])->name('blog.show');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/tag/{tag}', [TagController::class, 'show'])->name('tag.show');

// Authenticated blog routes
Route::middleware('auth')->group(function () {
    // Posts (role-based access)
    Route::middleware('permission:create posts')->group(function () {
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    });

    Route::middleware('permission:edit posts')->group(function () {
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    });

    Route::middleware('permission:delete posts')->delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Comments
    Route::middleware('permission:comment on posts')->group(function () {
        Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    });

    // Likes and Saves
    Route::middleware('permission:like posts')->post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('posts.like');
    Route::middleware('permission:save posts')->post('/posts/{post}/save', [PostController::class, 'toggleSave'])->name('posts.save');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('tags', TagController::class)->except(['show']);
    Route::get('/users', [ProfileController::class, 'index'])->name('admin.users');
    Route::get('/comments', [CommentController::class, 'index'])->name('admin.comments');
    Route::patch('/comments/{comment}/approve', [CommentController::class, 'approve'])->name('admin.comments.approve');
    Route::patch('/comments/{comment}/reject', [CommentController::class, 'reject'])->name('admin.comments.reject');
});

require __DIR__.'/auth.php';
