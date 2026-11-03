<?php

namespace App\Http\Controllers;

use App\Models\Post;

class MainController extends Controller
{
    public function index()
    {
        // $posts = Post::query()
        //     ->where('is_published', true)
        //     ->with('category')
        //     ->withCount('likes')
        //     ->latest()
        //     ->limit(8)              // на главной показываем 8 последних
        //     ->get();

        $allPosts = Post::query()
            ->where('is_published', true)
            ->withCount('likes')    // нужен likes_count для sum()
            ->get();

        return view('main', compact('allPosts'));
    }
}