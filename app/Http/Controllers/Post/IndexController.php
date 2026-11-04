<?php

namespace App\Http\Controllers\Post;

use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Models\Post;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $page    = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 12;
        $userId  = $request->user()?->id;

        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);

        $posts = Post::filter($filter)
            ->where('is_published', true)
            ->with('category')
            ->withCount('likes')
            ->withExists(['likes as is_liked' => fn ($q) => $q->where('users.id', $userId)])
            ->paginate($perPage, ['*'], 'page', $page);

        return view('post.index', compact('posts'));
    }
}