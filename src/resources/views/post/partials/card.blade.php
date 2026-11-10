<article
    class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md hover:-translate-y-1 transition-all duration-200 group flex flex-col">
    <a href="{{ route('post.show', $post) }}" class="block">
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
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 002 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-300">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 002 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif
        </div>
    </a>

    <div class="p-5 flex flex-col flex-1">
        <div class="flex items-center justify-between mb-3">
            <time class="text-xs text-gray-500 font-medium">
                {{ $post->created_at->format('M d, Y') }}
            </time>

            @if ($post->category)
                <a href="{{ route('post.index', ['category_id' => $post->category->id]) }}"
                    class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                    {{ $post->category->title }}
                </a>
            @endif
        </div>

        <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-1">
            <a href="{{ route('post.show', $post) }}">{{ $post->title }}</a>
        </h2>

        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
            {{ str($post->content)->limit(140) }}
        </p>

        <div class="mt-auto flex items-center justify-between text-xs text-gray-500 font-medium">
            @include('post.partials.like-button', ['post' => $post, 'size' => 'sm'])

            @isset($post->comments_count)
                <span class="flex items-center gap-1">
                    {{-- иконка комментария --}}
                    {{ $post->comments_count }}
                </span>
            @endisset


        </div>
    </div>
</article>
