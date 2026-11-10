<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use Illuminate\Http\Request;

class ShowController extends BaseController
{
    public function __invoke(Request $request, Post $post)
    {
        $userId = $request->user()?->id;

        $post->load([
            'category',
            'comments' => fn($q) => $q->with(['user', 'replies.user'])->latest(),
        ])
            ->loadCount('likes')
            ->loadExists(['likes as is_liked' => fn($q) => $q->where('users.id', $userId)]);

        return view('post.show', compact('post'));
    }
}
