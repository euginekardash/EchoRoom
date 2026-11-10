<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()?->id;

        $allPosts = Post::query()
            ->where('is_published', true)
            ->with('category')
            ->withCount('likes')
            ->withExists(['likes as is_liked' => fn ($q) => $q->where('users.id', $userId)])
            ->latest()
            ->get();

        return view('main', compact('allPosts'));
    }
}