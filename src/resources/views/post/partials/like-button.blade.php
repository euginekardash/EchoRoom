@php
    $liked = (bool) ($post->is_liked ?? false);
    $count = $post->likes_count ?? 0;
    $size  = $size ?? 'md';              // 'sm' для карточки, 'md' для show
    $iconClass = $size === 'sm' ? 'w-4 h-4' : 'w-5 h-5';
@endphp

@auth
    <button type="button"
        class="js-like-btn flex items-center gap-1 font-medium transition-colors
               {{ $liked ? 'text-red-500' : 'text-gray-500 hover:text-red-500' }}"
        data-url="{{ route('post.like', $post) }}"
        data-post-id="{{ $post->id }}"
        data-liked="{{ $liked ? '1' : '0' }}">
        <svg class="js-like-icon {{ $iconClass }} {{ $liked ? 'fill-current' : 'fill-none' }}"
             stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
        <span class="js-like-count">{{ $count }}</span>
    </button>
@else
    <a href="{{ route('login') }}"
       class="flex items-center gap-1 font-medium text-gray-500 hover:text-red-500 transition-colors">
        <svg class="{{ $iconClass }} fill-none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
        <span>{{ $count }}</span>
    </a>
@endauth