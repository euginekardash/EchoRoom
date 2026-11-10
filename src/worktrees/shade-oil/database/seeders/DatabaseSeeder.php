<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Category::factory(20)->create();
        $tags = Tag::factory(40)->create();
        $posts = Post::factory(200)->create();

        $posts->map(function ($post) use ($tags) { //random count of tags attach to posts
            $tagsCount = random_int(1, 9);
            $tagsForPostIds = $tags->random($tagsCount)->pluck('id');
            $post->tags()->attach($tagsForPostIds);
        });
    }
}
