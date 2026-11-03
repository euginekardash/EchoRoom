<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // --- 1. Пользователи ---
        // 1 админ + 20 обычных
        $admin = User::factory()->create([
            'name'  => 'Admin',
            'email' => 'admin@example.com',
            'role'  => 'admin',
        ]);

        $users = User::factory(20)->create();

        // --- 2. Категории, теги, посты ---
        Category::factory(20)->create();
        $tags  = Tag::factory(40)->create();
        $posts = Post::factory(200)->create();

        // теги постам
        $posts->each(function (Post $post) use ($tags) {
            $tagsCount      = random_int(1, 9);
            $tagsForPostIds = $tags->random($tagsCount)->pluck('id');
            $post->tags()->attach($tagsForPostIds);
        });

        // --- 3. Лайки ---
        // Каждому посту — случайные юзеры (включая админа иногда)
        $allUsers = $users->push($admin);

        $posts->each(function (Post $post) use ($allUsers) {
            $likersCount = random_int(0, min(10, $allUsers->count()));
            if ($likersCount === 0) {
                return;
            }
            $likerIds = $allUsers->random($likersCount)->pluck('id');
            // syncWithoutDetaching защищает от дублей (у нас unique(post_id,user_id))
            $post->likes()->syncWithoutDetaching($likerIds);
        });

        // --- 4. Комментарии (дерево) ---
        $posts->each(function (Post $post) use ($allUsers) {
            // 0–5 корневых комментариев на пост
            $rootsCount = random_int(0, 5);

            for ($i = 0; $i < $rootsCount; $i++) {
                /** @var Comment $root */
                $root = Comment::factory()->create([
                    'post_id'   => $post->id,
                    'user_id'   => $allUsers->random()->id,
                    'parent_id' => null,
                ]);

                // 0–3 ответа на корневой
                $repliesCount = random_int(0, 3);
                for ($j = 0; $j < $repliesCount; $j++) {
                    /** @var Comment $reply */
                    $reply = Comment::factory()->create([
                        'post_id'   => $post->id,
                        'user_id'   => $allUsers->random()->id,
                        'parent_id' => $root->id,
                    ]);

                    // 0–2 ответа на ответ (2-й уровень вложенности)
                    $deepCount = random_int(0, 2);
                    if ($deepCount > 0) {
                        Comment::factory($deepCount)->create([
                            'post_id'   => $post->id,
                            'user_id'   => $allUsers->random()->id,
                            'parent_id' => $reply->id,
                        ]);
                    }
                }
            }
        });
    }
}