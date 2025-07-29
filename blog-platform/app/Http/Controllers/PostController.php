<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['author', 'category', 'tags'])
            ->published()
            ->latest('published_at')
            ->paginate(12);

        // Get pending comments for moderation (only for users who can moderate)
        $comments = collect();
        if (Auth::check() && Auth::user()->can('moderate comments')) {
            $comments = Comment::with(['post', 'user'])
                ->where('status', 'pending')
                ->latest()
                ->paginate(10);
        }

        return view('blog.index', compact('posts', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $validated['author_id'] = Auth::id();

        // Generate unique slug
        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $validated['slug'] = $slug;

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        // Handle image upload with resizing
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();

            // Resize image
            $manager = new ImageManager(new Driver());
            $resizedImage = $manager->read($image)->resize(800, 600, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            // Store in S3
            Storage::disk('s3')->put('images/posts/' . $filename, $resizedImage->encode(), 'public');
            $validated['featured_image'] = 'images/posts/' . $filename;
        }

        $post = Post::create($validated);

        // Attach tags
        if (!empty($validated['tags'])) {
            $post->tags()->attach($validated['tags']);
        }

        return redirect()->route('blog.show', $post)
            ->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Increment view count
        $post->increment('views_count');

        $post->load([
            'author',
            'category',
            'tags',
            'approvedComments' => function ($query) {
                $query->whereNull('parent_id')->with(['user', 'replies.user']);
            }
        ]);

        // Check if user has liked or saved this post
        $hasLiked = Auth::check() ? $post->likes()->where('user_id', Auth::id())->exists() : false;
        $hasSaved = Auth::check() ? $post->savedByUsers()->where('user_id', Auth::id())->exists() : false;

        return view('blog.show', compact('post', 'hasLiked', 'hasSaved'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::all();
        $tags = Tag::all();
        $selectedTags = $post->tags->pluck('id')->toArray();

        return view('posts.edit', compact('post', 'categories', 'tags', 'selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        // Generate unique slug only if title changed
        if ($validated['title'] !== $post->title) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $counter = 1;

            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $validated['slug'] = $slug;
        }

        if ($validated['status'] === 'published' && !$post->published_at) {
            $validated['published_at'] = now();
        }

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image from S3
            if ($post->featured_image) {
                Storage::disk('s3')->delete($post->featured_image);
            }

            $image = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();

            $manager = new ImageManager(new Driver());
            $resizedImage = $manager->read($image)->resize(800, 600, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            // Store in S3
            Storage::disk('s3')->put('images/posts/' . $filename, $resizedImage->encode(), 'public');
            $validated['featured_image'] = 'images/posts/' . $filename;
        }

        $post->update($validated);

        // Sync tags
        $post->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('blog.show', $post)
            ->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // Delete featured image
        if ($post->featured_image && file_exists(public_path($post->featured_image))) {
            unlink(public_path($post->featured_image));
        }

        $post->delete();

        return redirect()->route('blog.index')
            ->with('success', 'Post deleted successfully!');
    }

    public function toggleLike(Post $post)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Authentication required'], 401);
        }

        $like = $post->likes()->where('user_id', Auth::id())->first();

        if ($like) {
            $like->delete();
            $post->decrement('likes_count');
            $liked = false;
        } else {
            $post->likes()->create(['user_id' => Auth::id()]);
            $post->increment('likes_count');
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes_count' => $post->fresh()->likes_count
        ]);
    }

    public function toggleSave(Post $post)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Authentication required'], 401);
        }

        $saved = $post->savedByUsers()->toggle(Auth::id());

        return response()->json([
            'saved' => !empty($saved['attached']),
        ]);
    }
}
