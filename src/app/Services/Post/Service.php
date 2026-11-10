<?php

namespace App\Services\Post;

use App\Models\Post;

class Service
{
    public function store(array $data): Post
    {
        $tags = $data['tags'] ?? [];
        unset($data['tags']);
        
        /** @var \Illuminate\Contracts\Auth\Guard $auth */
        $auth = auth();
        $data['user_id'] = $auth->id();

        $post = Post::create($data);   // ← не [$data, ...], а просто $data
        $post->tags()->attach($tags);

        return $post;
    }
    public function update($post, $data)
    {
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);

        return $post->fresh(); //for front
    }
}
