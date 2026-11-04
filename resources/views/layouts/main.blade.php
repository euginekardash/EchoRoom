<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoRoom</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 p-6 font-sans text-gray-800">

    <!-- Навигация -->
    @auth
        <nav class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-2 mb-6">
            <div class="flex items-center justify-between px-4">
                <ul class="flex space-x-4">
                    <li>
                        <a href="{{ route('main.index') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                            Main
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('post.index') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                            Posts
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about.index') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                            About
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact.index') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                            Contacts
                        </a>
                    </li>
                </ul>

                <!-- Profile image button -->
                <div class="flex items-center gap-2">
                    <a href="{{ route('profile.show') }}"
                        class="flex items-center gap-2 px-3 py-2 text-gray-600 hover:bg-blue-50 rounded-lg transition-colors group">
                        <span
                            class="text-sm font-medium text-gray-800 group-hover:text-blue-600">{{ Auth::user()->name }}</span>
                        @if (auth()->user()->image && file_exists(storage_path('app/public/' . auth()->user()->image)))
                            <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Profile"
                                class="w-8 h-8 rounded-full object-cover border border-gray-200">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=blue-600&color=fff&size=128"
                                alt="Profile" class="w-8 h-8 rounded-full object-cover border border-gray-200">
                        @endif
                    </a>

                    <!-- Logout button -->
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    @endauth

    <!-- Контент -->
    <main class="max-w-4xl mx-auto">
        @yield('content')
        @stack('scripts')
    </main>


    <script>
        // ── Синхронизация состояния лайков при возврате из bfcache ──
        document.addEventListener('pageshow', async (event) => {
            if (!event.persisted) return; // обычная загрузка — данные уже свежие

            const buttons = document.querySelectorAll('.js-like-btn[data-post-id]');
            if (!buttons.length) return;

            const ids = [...new Set([...buttons].map(b => b.dataset.postId))];

            try {
                const params = new URLSearchParams();
                ids.forEach(id => params.append('ids[]', id));

                const res = await fetch(`{{ route('likes.statuses') }}?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin',
                });
                if (!res.ok) return;

                const list = await res.json();
                for (const item of list) {
                    document.querySelectorAll(`.js-like-btn[data-post-id="${item.id}"]`)
                        .forEach(b => updateLikeButton(b, {
                            liked: item.liked,
                            count: item.count
                        }));
                }
            } catch (e) {
                console.error(e);
            }
        });

        // ── Клик по лайку ──
        document.addEventListener('click', async (e) => {
            window.addEventListener('pageshow', (event) => {
                if (event.persisted) window.location.reload();
            });

            const btn = e.target.closest('.js-like-btn');
            if (!btn || btn.disabled) return;

            e.preventDefault();
            btn.disabled = true;

            const url = btn.dataset.url;
            const csrf = document.querySelector('meta[name="csrf-token"]')?.content ||
                '{{ csrf_token() }}';

            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json',
                    },
                    credentials: 'same-origin',
                });
                if (!res.ok) throw new Error('HTTP ' + res.status);

                const data = await res.json();
                document.querySelectorAll(`.js-like-btn[data-post-id="${btn.dataset.postId}"]`)
                    .forEach(b => updateLikeButton(b, data));
            } catch (err) {
                console.error(err);
            } finally {
                btn.disabled = false;
            }
        });

        // ── Отрисовка состояния ──
        function updateLikeButton(btn, {
            liked,
            count
        }) {
            btn.dataset.liked = liked ? '1' : '0';

            const icon = btn.querySelector('.js-like-icon');
            const countEl = btn.querySelector('.js-like-count');
            if (countEl) countEl.textContent = count;

            icon.classList.toggle('fill-current', liked);
            icon.classList.toggle('fill-none', !liked);

            btn.classList.toggle('text-red-500', liked);
            btn.classList.toggle('text-gray-500', !liked);
            btn.classList.toggle('hover:text-red-500', !liked);
        }
    </script>

</body>

</html>
