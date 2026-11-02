<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', true)
            ->latest()
            ->take(6)
            ->with('category')
            ->get();

        $allPosts = Post::where('is_published', true)
            ->get();

        return view('main', compact('posts','allPosts'));
    }
}
