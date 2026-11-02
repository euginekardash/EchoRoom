@extends('layouts.main')

@section('content')

<!-- Page Header -->
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">All Articles</h1>
            <p class="text-gray-600">Browse our latest published posts.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('post.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 hover:text-gray-900 font-medium transition-colors">
                Reset filters
            </a>
            <a href="{{ route('post.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create Post
            </a>
        </div>
    </div>
</div>

<!-- Filters / Search -->
<form method="GET" action="{{ route('post.index') }}" class="max-w-2xl mx-auto mb-8">
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 flex flex-col md:flex-row gap-4 items-end">
        <div class="flex-1">
            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title or content..."
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
        </div>
        <div class="flex-1">
            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Category</label>
            <select name="category" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all bg-gray-50">
                <option value="">All categories</option>
                @foreach (\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Filter
        </button>
    </div>
</form>

@if ($posts->isNotEmpty())
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md hover:-translate-y-1 transition-all duration-200 group">
                    <div class="h-48 relative bg-gray-200 overflow-hidden">
                        @if ($post->image)
                            @if (str_starts_with($post->image, 'http'))
                                <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @elseif (file_exists(storage_path('app/public/' . $post->image)))
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-3 left-3">
                            <span
                                class="inline-block px-2.5 py-1 bg-blue-900 text-white text-[10px] font-bold uppercase rounded tracking-tighter opacity-90 group-hover:opacity-100 transition-opacity">
                                {{ $post->category->name ?? 'General' }}
                            </span>
                        </div>
                        @if ($post->is_published)
                            <div class="absolute top-3 right-3">
                                <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-[10px] font-medium rounded">
                                    Published
                                </span>
                            </div>
                        @else
                            <div class="absolute top-3 right-3">
                                <span class="inline-block px-2 py-1 bg-gray-100 text-gray-600 text-[10px] font-medium rounded">
                                    Draft
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-3">
                            <time class="text-xs text-gray-500 font-medium">{{ $post->created_at->format('M d, Y') }}</time>
                            @if ($post->likes)
                                <span class="flex items-center gap-1 text-xs text-gray-500 font-medium">
                                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20">
                                        <path d="M4.318 6.318a2.5 2.5 0 013.536 0L10 8.6l2.146-2.282a2.5 2.5 0 113.536 3.536L13 15.44l4.854-5.07a2.5 2.5 0 113.536 3.536L16.586 19l-4.854-5.07-4.854 5.07L2.732 13.374a2.5 2.5 0 010-3.536z" /></svg>
                                    {{ $post->likes }}
                                </span>
                            @endif
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-1">
                            <a href="{{ route('post.show', $post) }}">{{ $post->title }}</a>
                        </h2>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ str($post->content)->limit(140) }}</p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <a href="{{ route('post.show', $post) }}"
                                class="text-blue-600 font-semibold text-sm hover:text-blue-700 inline-flex items-center gap-1">
                                Read more <span>→</span>
                            </a>
                            <a href="{{ route('post.show', $post) }}#comments" class="text-gray-400 hover:text-gray-600 text-sm">
                                Comments
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10 flex justify-center">
            {{ $posts->withQueryString()->links() }}
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
            <a href="{{ route('post.index') }}" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                Browse all posts
            </a>
        @endauth
    </div>
@endif

@endsection
