<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends BaseController
{
    public function toggle(Request $request, Post $post)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $result = $post->likes()->toggle($user->id);

        $liked = count($result['attached']) > 0;
        $count = $post->likes()->count();

        if ($request->expectsJson()) {
            return response()->json([
                'liked' => $liked,
                'count' => $count,
            ]);
        }

        return back();
    }

    public function statuses(Request $request)
    {
        $data = $request->validate([
            'ids'   => ['required', 'array'],
            'ids.*' => ['integer'],
        ]);

        /** @var \App\Models\User $user */
        $user = $request->user();

        $posts = Post::query()
            ->whereIn('id', $data['ids'])
            ->withCount('likes')
            ->withExists(['likes as is_liked' => fn($q) => $q->where('users.id', $user->id)])
            ->get(['id']);

        return response()->json(
            $posts->map(fn($p) => [
                'id'    => $p->id,
                'liked' => (bool) $p->is_liked,
                'count' => (int) $p->likes_count,
            ])
        );
    }
}
