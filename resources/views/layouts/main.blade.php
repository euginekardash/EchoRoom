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
    <nav class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-2 mb-6">
        <ul class="flex justify-center space-x-4">
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
    </nav>

    <!-- Контент -->
    <main class="max-w-4xl mx-auto">
        @yield('content')
    </main>

</body>

</html>