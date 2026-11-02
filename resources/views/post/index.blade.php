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
            {{-- <a href="{{ route('post.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 hover:text-gray-900 font-medium transition-colors">
                Reset filters
            </a> --}}
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
            <div class="relative">
                <input type="text" name="title" value="{{ request('title') }}"
                    placeholder="Search by title or content..."
                    class="w-full px-4 py-2.5 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                @if (request()->filled('title'))
                    <a href="{{ route('post.index', request()->except('title', 'page')) }}"
                       class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-700 transition-colors"
                       title="Clear search">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </div>
        </div>
        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Search
        </button>
    </div>
</form>

@if ($posts->isNotEmpty())
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                @include('post.card', ['post' => $post])
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
