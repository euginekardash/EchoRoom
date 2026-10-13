<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', 0)->get(); //get получает все данные в виде коллекций 
        foreach ($posts as $post) {
            dump($post->title); //красивый метод вывода без остановки скрипта
        }
        dd('end'); //остонавливает скрипт и красивы выводит данные 
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

        foreach($postsArr as $item){
            Post::create($item);
        }

        dd('created');
    }
}
