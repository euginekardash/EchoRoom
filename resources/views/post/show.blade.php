@extends('layouts.main')

@section('content')
    <!-- Back link + Actions -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <a href="{{ route('post.index') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors w-fit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to all articles
            </a>

            <div class="flex gap-2">
                <a href="{{ route('post.edit', $post->id) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 hover:text-gray-900 font-medium transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>

                <form action="{{ route('post.delete', $post->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Article Card -->
    <article class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

        <!-- Header -->
        <header class="p-8 border-b border-gray-100">
            <div class="flex items-center justify-between gap-4 mb-3">
                <div class="flex items-center gap-2 text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a2 2 0 012-2z" />
                    </svg>
                    Article #{{ $post->id }}
                </div>

                <div class="flex items-center gap-4">
                    <time class="text-xs text-gray-500 font-medium">
                        {{ $post->created_at->format('M d, Y') }}
                    </time>
                    @include('post.partials.like-button', ['post' => $post, 'size' => 'md'])
                </div>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight line-clamp-2 break-words"
                title="{{ $post->title }}">
                {{ $post->title }}
            </h1>
        </header>

        <!-- Content -->
        <div class="p-8">
            <div class="prose prose-gray max-w-none text-gray-700 leading-relaxed whitespace-pre-line break-words">
                {{ $post->content }}
            </div>
        </div>
    </article>
    {{-- ============ Comments ============ --}}
<section class="max-w-3xl mx-auto mt-10">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

        {{-- Заголовок --}}
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                Комментарии
                <span class="text-sm font-normal text-gray-500">({{ $post->allComments->count() }})</span>
            </h2>
        </div>

        {{-- Форма нового комментария --}}
        @auth
            <div class="p-6 border-b border-gray-100">
                <form action="{{ route('comments.store', $post) }}" method="POST">
                    @csrf
                    <div class="flex gap-3">
                        <div class="shrink-0">
                            @if (auth()->user()->image && file_exists(storage_path('app/public/' . auth()->user()->image)))
                                <img src="{{ asset('storage/' . auth()->user()->image) }}"
                                     alt="{{ auth()->user()->name }}"
                                     class="w-9 h-9 rounded-full object-cover border border-gray-200">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=3b82f6&color=fff&size=64"
                                     alt="{{ auth()->user()->name }}"
                                     class="w-9 h-9 rounded-full object-cover border border-gray-200">
                            @endif
                        </div>
                        <div class="flex-1">
                            <textarea name="content" rows="3" required
                                      placeholder="Поделитесь мыслями..."
                                      class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                            <div class="flex justify-end mt-2">
                                <button type="submit"
                                        class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors">
                                    Отправить
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div class="p-6 border-b border-gray-100 text-sm text-gray-600">
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    Войдите
                </a>
                , чтобы оставить комментарий.
            </div>
        @endauth

        {{-- Список комментариев --}}
        <div class="p-6">
            @if ($post->comments->isEmpty())
                <div class="text-center py-10">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">Пока нет комментариев</p>
                    <p class="text-gray-400 text-sm mt-1">Будьте первым!</p>
                </div>
            @else
                <div class="space-y-5">
                    @foreach ($post->comments as $comment)
                        @include('post.partials.comment', [
                            'comment' => $comment,
                            'post' => $post,
                            'depth' => 0,
                        ])
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
@endsection