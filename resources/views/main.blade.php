@extends('layouts.main')

@section('content')

<!-- Hero Section -->
<section class="py-16 bg-blue-900 text-white overflow-hidden relative">
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&amp;auto=format&amp;fit=crop&amp;w=1920&amp;q=80')] bg-cover bg-center opacity-20"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 tracking-tight">Welcome to our Blog</h1>
        <p class="text-xl md:text-2xl text-blue-100 mb-10 max-w-2xl mx-auto">
            Discover insightful articles, tutorials, and stories crafted for curious minds.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('post.index') }}" class="px-8 py-4 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-semibold text-lg transition-colors shadow-lg">
                Browse Articles
            </a>
            @auth
                <a href="{{ route('post.create') }}" class="px-8 py-4 bg-white hover:bg-gray-100 text-blue-900 rounded-lg font-semibold text-lg transition-colors">
                    Write a Post
                </a>
            @else
                <a href="{{ route('login') }}" class="px-8 py-4 border-2 border-white hover:bg-white hover:text-blue-900 text-white rounded-lg font-semibold text-lg transition-colors">
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
                <h3 class="text-3xl font-bold text-blue-900">{{ $posts->count() }}</h3>
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
<section class="py-16 bg-gray-50">
    <div class="max-w-5xl mx-auto px-6">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-3xl font-bold text-gray-900">Featured Articles</h2>
            <a href="{{ route('post.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">View all posts &rarr;</a>
        </div>

        @if ($posts->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($posts as $post)
                    <article class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden border border-gray-100">
                        <div class="h-48 bg-gray-200 relative">
                        @if ($post->image)
                            @if (str_starts_with($post->image, 'http'))
                                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                            @elseif (file_exists(storage_path('app/public/' . $post->image)))
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        @endif
                        <div class="absolute top-4 right-4 bg-blue-900 text-white text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider">
                                {{ $post->category->name ?? 'General' }}
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex text-xs text-gray-500 mb-2">
                                <span>{{ $post->created_at->format('M d, Y') }}</span>
                                @if ($post->category)
                                    <span class="ml-2">|</span>
                                    <span>{{ $post->category->name }}</span>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 leading-tight group-hover:text-blue-600 transition-colors">
                                <a href="{{ route('post.show', $post) }}" class="block">{{ $post->title }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ str($post->content)->limit(120) }}
                            </p>
                            <a href="{{ route('post.show', $post) }}" class="text-blue-600 font-semibold text-sm hover:text-blue-800 inline-flex items-center gap-1">
                                Read more <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else>
            <div class="text-center py-20">
                <p class="text-gray-500">No articles published yet. Be the first to write one!</p>
                @auth
                    <a href="{{ route('post.create') }}" class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        Create Your First Post
                    </a>
                @endauth
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-16">
    <div class="max-w-4xl mx-auto px-6">
        <div class="bg-blue-900 rounded-2xl p-8 md:p-12 text-white text-center shadow-xl">
            <h2 class="text-3xl font-bold mb-4">Join our community</h2>
            <p class="text-blue-100 mb-8 text-lg">Subscribe to get the latest articles delivered straight to your inbox.</p>
            <form class="flex flex-col sm:flex-row justify-center gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Enter your email" class="px-6 py-3 rounded-lg text-gray-900 w-full sm:w-80 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <button type="submit" class="px-8 py-3 bg-blue-500 hover:bg-blue-400 text-white rounded-lg font-semibold transition-colors">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</section>

@endsection
