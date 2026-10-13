<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        
        return view('posts', compact('posts')); //compact - передаем переменные во вью
    }

    public function create()
    {
        $postsArr = [
            [
                'title' => 'very int title',
                'content' => 'big content',
                'image' => 'iamge.jpg',
                'likes' => 15,
                'is_published' => 1,
            ],
            [
                'title' => 'another very int title',
                'content' => 'another big content',
                'image' => 'another_iamge.jpg',
                'likes' => 25,
                'is_published' => 1,
            ],
        ];

        foreach ($postsArr as $item) {
            Post::create($item);
        }

        dd('created');
    }

    public function update()
    {
        $post = Post::find(6);
        $post->update([
            'title' => 'updated'
        ]);
        dd('updated');
    }

    public function delete()
    {
        $post = Post::find(2);
        $post->delete();
        dd('deleted');
    }

    public function firstOrCreate()
    {
        $post = Post::find(1);
        $anotherPost = [
            'title' => 'some title',
            'content' => 'some content',
            'image' => 'some_iamge.jpg',
            'likes' => 250,
            'is_published' => 1,
        ];
        $post = Post::firstOrCreate(
            ['title' => 'some title'], //ключи на проверку совпадений 
            [                          //если не находит то создает
                'title' => 'some title',
                'content' => 'some content',
                'image' => 'some_iamge.jpg',
                'likes' => 250,
                'is_published' => 1,
            ]
        );
        dump($post->content);
        dd('end');
    }

    public function updateOrCreate()
    {
        $anotherPost = [
            'title' => 'updateorcreate some title',
            'content' => 'updateorcreate some content',
            'image' => 'updateorcreate some_iamge.jpg',
            'likes' => 250,
            'is_published' => 0,
        ];

        $post = Post::updateOrCreate([
            'title' => 'updateorcreate some title',
        ], [
            'title' => 'updateorcreate some title',
            'content' => 'updateorcreate some content',
            'image' => 'updateorcreate some_iamge.jpg',
            'likes' => 250,
            'is_published' => 0,
        ]);
        dd('end');
    }
}
