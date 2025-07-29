<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests; // Add this trait

    public function store(Request $request, Post $post)
    {
        $this->authorize('comment on posts');

        $validated = $request->validate([
            'content' => 'required|string|min:3|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $comment = Comment::create([
            'content' => $validated['content'],
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'parent_id' => $validated['parent_id'] ?? null,
            'status' => Auth::user()->hasRole('admin') ? 'approved' : 'pending'
        ]);

        // Update post comment count
        $post->increment('comments_count');

        return back()->with('success', 'Comment added successfully!');
    }

    public function index()
    {
        $this->authorize('moderate comments');

        $comments = Comment::with(['post', 'user'])
                          ->where('status', 'pending')
                          ->latest()
                          ->paginate(20);

        return view('admin.comments.index', compact('comments'));
    }

    public function approve(Comment $comment)
    {
        $this->authorize('moderate comments');

        $comment->update(['status' => 'approved']);

        return back()->with('success', 'Comment approved successfully!');
    }

    public function reject(Comment $comment)
    {
        $this->authorize('moderate comments');

        $comment->update(['status' => 'rejected']);

        return back()->with('success', 'Comment rejected successfully!');
    }
}
