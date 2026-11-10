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
            'title'=>fake()->sentence(5),
            'content'=>fake()->text(30),
            'image'=>fake()->imageUrl(),
            'likes'=>random_int(1,200),
            'is_published'=>1,
            'category_id'=>Category::get()->random()->id,
        ];
    }
}
