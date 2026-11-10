@extends('layouts.main')

@section('content')

<div class="min-h-[calc(100vh-160px)] flex items-center justify-center px-6 py-12 bg-gray-50">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-600">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.418-9L19.319 7.772a2 2 0 010 2.456l-4.69 4.69a2 2 0 01-2.828 0l-4.69-4.69a2 2 0 010-2.456l4.69-4.69a2 2 0 012.828 0z" />
                </svg>
            </div>
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900 tracking-tight">Forgot your password?</h2>
            <p class="mt-2 text-gray-600">No problem. Just let us know your email and we will send you a password reset link.</p>
        </div>

        @if (session('status'))
            <div class="mb-4 p-4 bg-blue-50 border border-blue-200 text-blue-800 rounded-lg text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-6">
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

            <div>
                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                    Send Password Reset Link
                </button>
            </div>
        </form>

        <p class="mt-8 text-center text-sm text-gray-600">
            Remember your password?
            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors">
                Sign in
            </a>
        </p>
    </div>
</div>

@endsection
