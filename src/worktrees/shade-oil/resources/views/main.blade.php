@extends('layouts.main')

@section('content')

    <!-- Hero Section -->
    <section class="py-16 bg-blue-900 text-white overflow-hidden relative">
        <div
            class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&amp;auto=format&amp;fit=crop&amp;w=1920&amp;q=80')] bg-cover bg-center opacity-20">
        </div>
        <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 tracking-tight">Welcome to our Blog</h1>
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
                    <h3 class="text-3xl font-bold text-blue-900">10+</h3>
                    <p class="text-gray-500 font-medium">Categories</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl">
                    <h3 class="text-3xl font-bold text-blue-900">50+</h3>
                    <p class="text-gray-500 font-medium">Tags</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl">
                    <h3 class="text-3xl font-bold text-blue-900">1k+</h3>
                    <p class="text-gray-500 font-medium">Readers</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Posts -->
    @if ($posts->isNotEmpty())
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    @include('post.card', ['post' => $post])
                @endforeach
            </div>
        </div>
    @else
        <div class="max-w-xl mx-auto text-center py-20">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 12H4" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">No articles found</h2>
            <p class="text-gray-500 mb-8">Try adjusting your filters or check back later for new content.</p>
            @auth
                <a href="{{ route('post.create') }}"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium shadow-sm hover:shadow-md transition-all">
                    Write your first post
                </a>
            @else
                <a href="{{ route('post.index') }}"
                    class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                    Browse all posts
                </a>
            @endauth
        </div>
    @endif

    <!-- CTA Section -->
    <section class="py-16">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-blue-900 rounded-2xl p-8 md:p-12 text-white text-center shadow-xl">
                <h2 class="text-3xl font-bold mb-4">Join our community</h2>
                <p class="text-blue-100 mb-8 text-lg">Subscribe to get the latest articles delivered straight to your inbox.
                </p>
                <form class="flex flex-col sm:flex-row justify-center gap-4 max-w-md mx-auto">
                    <input type="email" placeholder="Enter your email"
                        class="px-6 py-3 rounded-lg text-gray-900 w-full sm:w-80 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <button type="submit"
                        class="px-8 py-3 bg-blue-500 hover:bg-blue-400 text-white rounded-lg font-semibold transition-colors">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </section>

@endsection
