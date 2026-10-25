<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        
        return view('post.index', compact('posts')); //compact - передаем переменные во вью
    }

    public function create()
    {
        return view('post.create', );
    }

    public function store(){
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);
        Post::create($data);
        return redirect()->route('post.index');
    }

    public function show(Post $post){
        return view('post.show', compact('post'));
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
