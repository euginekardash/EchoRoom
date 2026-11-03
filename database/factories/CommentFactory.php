<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'post_id'   => Post::inRandomOrder()->value('id'),
            'user_id'   => User::inRandomOrder()->value('id'),
            'parent_id' => null,
            'content'   => fake()->paragraph(),
        ];
    }
}