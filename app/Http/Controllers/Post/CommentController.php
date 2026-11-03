<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'content'   => ['required', 'string', 'min:1', 'max:2000'],
            'parent_id' => ['nullable', 'integer', 'exists:comments,id'],
        ]);

        if (!empty($data['parent_id'])) {
            $parent = Comment::findOrFail($data['parent_id']);
            abort_unless($parent->post_id === $post->id, 422);
        }

        $post->allComments()->create([
            'user_id'   => $request->user()->id,
            'parent_id' => $data['parent_id'] ?? null,
            'content'   => $data['content'],
        ]);

        return back();
    }

    public function destroy(Comment $comment)
    {
        abort_unless($comment->user_id === auth()->id || auth()->user->role === 'admin', 403);
        $comment->delete();
        return back();
    }
}
