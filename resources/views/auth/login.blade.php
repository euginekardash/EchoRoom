@extends('layouts.main')

@section('content')

<div class="min-h-[calc(100vh-160px)] flex items-center justify-center px-6 py-12 bg-gray-50">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-600">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                </svg>
            </div>
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900 tracking-tight">Welcome back</h2>
            <p class="mt-2 text-gray-600">Please enter your details to sign in.</p>
        </div>

        @if (session('status'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all sm:text-sm"
                    placeholder="you@example.com" autocomplete="email" autofocus>

                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" type="password" name="password" required
                        class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all sm:text-sm"
                        autocomplete="current-password">

                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="text-sm">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors">
                            Forgot password?
                        </a>
                    @endif
                </div>
            </div>

            <div class="flex items-center">
                <input id="remember" type="checkbox" name="remember"
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
            </div>

            <div>
                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                    Sign in
                </button>
            </div>
        </form>

        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-xs">
                <span class="px-4 bg-white text-gray-500">Or continue with</span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <a href="#" class="flex items-center justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                    <path fill="#4285F4" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.53-3.53c-.87.44-1.91.72-3.05.72-2.43 0-4.6-1.12-6.1-3.02l-3.27 3.02C5.34 22.02 8.39 23 12 23" />
                    <path fill="#34A853" d="M5.84 14.09c-.15-.61-.24-1.25-.24-1.89s.09-1.28.24-1.89l3.27-3.02c-1.5-1.9-3.78-3.11-6.1-3.11-3.22 0-5.96 2.06-6.9 5.11l3.26 3.02c.86.79 1.98 1.26 3.22 1.26 1.34 0 2.53-.54 3.43-1.46l2.59-2.39c.62-.56.98-1.38.98-2.29s-.36-1.72-.98-2.29l2.59-2.39c-.9-.92-2.09-1.46-3.43-1.46-1.24 0-2.35.47-3.11 1.17l-3.26 3.02c-1.57 1.45-2.31 3.62-2.25 5.91s.72 4.46 2.29 5.91l3.26-3.02c-.75-.69-1.17-1.6-1.17-2.62z" />
                    <path fill="#FBBC05" d="M12 23c-3.61 0-6.66-2.98-6.95-6.52l-3.26-3.02c-.1-.09-.15-.22-.15-.35s.05-.26.15-.35l3.26-3.02c.19-.17.31-.45.31-.75s-.12-.58-.31-.75l-3.26-3.02c-.1-.09-.15-.22-.15-.35s.05-.26.15-.35l3.26-3.02c2.33-2.12 5.79-3.51 9.58-3.51 3.6 0 6.66 1.39 9.15 3.62l3.26 3.02c-.1.09-.15.22-.15.35s.05.26.15.35l-3.26 3.02c-.19.17-.31.45-.31.75s.12.58.31.75l3.26 3.02c-.1.09-.15.22-.15.35s.05.26.15.35l-3.26 3.02c-.29.27-.6.52-.95.76-2.37 1.61-5.45 2.53-8.72 2.53z" />
                    <path fill="#EA4335" d="M12 1.02c-3.9 0-7.29 2.18-8.97 5.5l3.26 3.02c.48-.44 1.04-.72 1.66-.88 1.03-.26 2.19-.41 3.39-.41 1.92 0 3.65.77 4.92 2.03l3.26-3.02c-1.7-2.12-4.35-3.58-7.52-3.58z" />
                </svg>
                Google
            </a>
        </div>

        <p class="mt-8 text-center text-sm text-gray-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors">
                Create one
            </a>
        </p>
    </div>
</div>

@endsection
