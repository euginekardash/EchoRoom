<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title'        => fake()->sentence(6),
            'content'      => fake()->paragraphs(4, true),
            'image'        => null,
            'is_published' => fake()->boolean(85),
            'category_id'  => Category::inRandomOrder()->value('id'),
        ];
    }
}