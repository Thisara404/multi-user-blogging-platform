<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->posts()
                    ->with(['author', 'category', 'tags'])
                    ->published()
                    ->latest('published_at')
                    ->paginate(12);

        return view('blog.tag', compact('tag', 'posts'));
    }
}
