<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryController extends Controller
{
    use AuthorizesRequests; // Add this trait

    public function show(Category $category)
    {
        $posts = $category->posts()
                         ->with(['author', 'category', 'tags'])
                         ->published()
                         ->latest('published_at')
                         ->paginate(12);

        return view('blog.category', compact('category', 'posts'));
    }

    public function index()
    {
        $this->authorize('manage users');

        $categories = Category::withCount('posts')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $this->authorize('manage users');
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->authorize('manage users');

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string|max:500',
            'color' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/'
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
                        ->with('success', 'Category created successfully!');
    }
}
