@php
    /** @var \App\Models\Comment $comment */
    $depth   = $depth ?? 0;
    $isOwner = auth()->id() === $comment->user_id;
    $isAdmin = auth()->user()?->role === 'admin';
@endphp

<div class="flex gap-3 {{ $depth > 0 ? 'mt-4' : '' }}" id="comment-{{ $comment->id }}">

    {{-- Аватар --}}
    <div class="shrink-0">
        @if ($comment->user?->image && file_exists(storage_path('app/public/' . $comment->user->image)))
            <img src="{{ asset('storage/' . $comment->user->image) }}"
                 alt="{{ $comment->user->name }}"
                 class="w-9 h-9 rounded-full object-cover border border-gray-200">
        @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user?->name ?? 'User') }}&background=3b82f6&color=fff&size=64"
                 alt="{{ $comment->user?->name ?? 'User' }}"
                 class="w-9 h-9 rounded-full object-cover border border-gray-200">
        @endif
    </div>

    {{-- Тело --}}
    <div class="flex-1 min-w-0">
        <div class="bg-gray-50 rounded-2xl px-4 py-3 border border-gray-100">
            <div class="flex items-center justify-between gap-2 mb-1">
                <div class="flex items-center gap-2 min-w-0">
                    <span class="text-sm font-semibold text-gray-900 truncate">
                        {{ $comment->user?->name ?? 'Удалённый пользователь' }}
                    </span>
                    @if ($comment->user_id === $comment->post?->user_id ?? false)
                        <span class="text-[10px] font-medium uppercase tracking-wider text-blue-600 bg-blue-50 px-1.5 py-0.5 rounded">
                            Автор
                        </span>
                    @endif
                </div>
                <time class="text-xs text-gray-400 shrink-0"
                      datetime="{{ $comment->created_at->toIso8601String() }}">
                    {{ $comment->created_at->diffForHumans() }}
                </time>
            </div>

            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line break-words">
                {{ $comment->content }}
            </p>
        </div>

        {{-- Действия под комментарием --}}
        <div class="flex items-center gap-4 mt-1.5 ml-1 text-xs text-gray-500">
            @auth
                <button type="button"
                        class="js-reply-toggle hover:text-blue-600 font-medium transition-colors"
                        data-target="reply-form-{{ $comment->id }}">
                    Ответить
                </button>
            @endauth

            @if ($isOwner || $isAdmin)
                <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                      onsubmit="return confirm('Удалить комментарий?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="hover:text-red-600 font-medium transition-colors">
                        Удалить
                    </button>
                </form>
            @endif
        </div>

        {{-- Форма ответа (скрыта) --}}
        @auth
            <form action="{{ route('comments.store', $post) }}" method="POST"
                  id="reply-form-{{ $comment->id }}"
                  class="hidden mt-3">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <textarea name="content" rows="2" required
                          placeholder="Написать ответ..."
                          class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
                <div class="flex justify-end gap-2 mt-2">
                    <button type="button"
                            class="js-reply-cancel px-3 py-1.5 text-xs font-medium text-gray-600 hover:text-gray-900"
                            data-target="reply-form-{{ $comment->id }}">
                        Отмена
                    </button>
                    <button type="submit"
                            class="px-4 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-colors">
                        Отправить
                    </button>
                </div>
            </form>
        @endauth

        {{-- Ответы (рекурсивно) --}}
        @if ($comment->replies->isNotEmpty())
            <div class="mt-2 border-l-2 border-gray-100 pl-4">
                @foreach ($comment->replies as $reply)
                    @include('post.partials.comment', [
                        'comment' => $reply,
                        'post' => $post,
                        'depth' => $depth + 1,
                    ])
                @endforeach
            </div>
        @endif
    </div>
</div>