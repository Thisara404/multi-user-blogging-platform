<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    Route::middleware('permission:like posts')->post('/posts/{post:id}/like', [PostController::class, 'toggleLike'])->name('posts.like');
    Route::middleware('permission:save posts')->post('/posts/{post:id}/save', [PostController::class, 'toggleSave'])->name('posts.save');
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

// Add this temporary test route
Route::get('/test-s3', function() {
    try {
        // Test S3 connection
        $disk = Storage::disk('s3');

        // Try to create a test file
        $testContent = 'Test file - ' . now();
        $result = $disk->put('test/test.txt', $testContent);

        if ($result) {
            $url = $disk->url('test/test.txt');
            return response()->json([
                'status' => 'success',
                'message' => 'S3 connection working',
                'test_file_url' => $url,
                'config' => [
                    'region' => config('filesystems.disks.s3.region'),
                    'bucket' => config('filesystems.disks.s3.bucket'),
                ]
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to upload test file'
            ]);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
})->middleware('auth');

// Add this temporary debug route
Route::get('/debug-s3', function() {
    $post = \App\Models\Post::where('featured_image', '!=', null)->first();

    if (!$post) {
        return 'No posts with images found';
    }

    return [
        'featured_image_field' => $post->featured_image,
        'featured_image_url_method' => $post->featured_image_url,
        'direct_s3_url' => 'https://thisaradasun.s3.eu-north-1.amazonaws.com/' . $post->featured_image,
        'storage_s3_url' => Storage::disk('s3')->url($post->featured_image),
        'config_default_disk' => config('filesystems.default'),
        'app_environment' => app()->environment(),
    ];
})->middleware('auth');

require __DIR__.'/auth.php';
