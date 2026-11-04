@extends('layouts.main')

@section('content')

    <!-- Hero Section -->
    <section class="py-16 bg-blue-900 text-white overflow-hidden relative">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center opacity-20"></div>
        <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 tracking-tight">Welcome to EchoRoom</h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-10 max-w-2xl mx-auto">
                Discover insightful articles, tutorials, and stories crafted for curious minds.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('post.index') }}"
                    class="px-8 py-4 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-semibold text-lg transition-colors shadow-lg">
                    Browse Articles
                </a>
                @auth
                    <a href="{{ route('post.create') }}"
                        class="px-8 py-4 bg-white hover:bg-gray-100 text-blue-900 rounded-lg font-semibold text-lg transition-colors">
                        Write a Post
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-8 py-4 border-2 border-white hover:bg-white hover:text-blue-900 text-white rounded-lg font-semibold text-lg transition-colors">
                        Log In
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-white border-b">
        <div class="max-w-5xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-6 bg-gray-50 rounded-xl">
                    <h3 class="text-3xl font-bold text-blue-900">{{ $allPosts->count() }}</h3>
                    <p class="text-gray-500 font-medium">Published Articles</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl">
                    <h3 class="text-3xl font-bold text-blue-900">{{ $allPosts->pluck('category_id')->unique()->count() }}</h3>
                    <p class="text-gray-500 font-medium">Categories</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl">
                    <h3 class="text-3xl font-bold text-blue-900">{{ $allPosts->sum('likes_count') }}</h3>
                    <p class="text-gray-500 font-medium">Total Likes</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl">
                    <h3 class="text-3xl font-bold text-blue-900">{{ $allPosts->take(8)->count()}}</h3>
                    <p class="text-gray-500 font-medium">On this page</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest posts -->
    <section class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Latest Articles</h2>
            <a href="{{ route('post.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                View all →
            </a>
        </div>

        @if ($allPosts->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($allPosts->take(8) as $post)
                    @include('post.partials.card', ['post' => $post])
                @endforeach
            </div>
        @else
            <div class="max-w-xl mx-auto text-center py-20">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">No articles yet</h2>
                <p class="text-gray-500 mb-8">Check back later or create the first post.</p>
                @auth
                    <a href="{{ route('post.create') }}"
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium shadow-sm">
                        Write your first post
                    </a>
                @endauth
            </div>
        @endif
    </section>
@endsection