<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 p-6 font-sans text-gray-800">

    <!-- Навигация -->
    @auth
        <nav class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-2 mb-6">
            <div class="flex items-center justify-between px-4">
                <ul class="flex space-x-4">
                    <li>
                        <a href="{{ route('main.index') }}" class="block px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                            Main
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('post.index') }}" class="block px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                            Posts
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about.index') }}" class="block px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                            About
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact.index') }}" class="block px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                            Contacts
                        </a>
                    </li>
                </ul>

                <!-- Profile image button -->
                <div class="flex items-center gap-2">
                    <a href="{{ route('profile.show') }}"
                        class="flex items-center gap-2 px-3 py-2 text-gray-600 hover:bg-blue-50 rounded-lg transition-colors group">
                        <span class="text-sm font-medium text-gray-800 group-hover:text-blue-600">{{ Auth::user()->name }}</span>
                        @if (auth()->user()->image && file_exists(storage_path('app/public/' . auth()->user()->image)))
                            <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Profile"
                                class="w-8 h-8 rounded-full object-cover border border-gray-200">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=blue-600&color=fff&size=128"
                                alt="Profile"
                                class="w-8 h-8 rounded-full object-cover border border-gray-200">
                        @endif
                    </a>

                    <!-- Logout button -->
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
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
    </main>

</body>

</html>