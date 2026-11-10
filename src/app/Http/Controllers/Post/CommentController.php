<?php

namespace App\Http\Controllers\Post;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends BaseController
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'content'   => ['required', 'string', 'min:1', 'max:2000'],
            'parent_id' => ['nullable', 'integer', 'exists:comments,id'],
        ]);

        if (!empty($data['parent_id'])) {
            $parent = Comment::findOrFail($data['parent_id']);
            abort_unless($parent->post_id === $post->id, 422, 'Parent comment belongs to another post');
        }

        $post->allComments()->create([
            'user_id'   => $request->user()->id,
            'parent_id' => $data['parent_id'] ?? null,
            'content'   => $data['content'],
        ]);

        return back()->with('status', 'Comment added.');
    }

    public function destroy(Request $request, Comment $comment)
    {
        $user = $request->user();

        abort_unless(
            $comment->user_id === $user->id || $user->role === 'admin',
            403
        );

        $comment->delete();

        return back()->with('status', 'Comment deleted.');
    }
}