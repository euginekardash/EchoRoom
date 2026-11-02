@extends('layouts.main')

@section('content')

<!-- Page Header -->
<div class="mb-12 text-center">
    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 tracking-tight">About Us</h1>
    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        We are a passionate team dedicated to sharing knowledge, stories, and ideas that inspire and inform.
    </p>
</div>

<!-- Main Content Card -->
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        
        <!-- Hero Image / Banner Area (Optional) -->
        <div class="h-48 bg-gradient-to-r from-blue-600 to-indigo-700 flex items-center justify-center">
            <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" />
            </svg>
        </div>

        <div class="p-8 md:p-12">
            <!-- Mission Section -->
            <div class="prose prose-lg prose-blue max-w-none text-gray-600 mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h2>
                <p class="mb-4">
                    We believe in the power of words. Our platform was created to give writers a beautiful space to express themselves, and to give readers a curated collection of high-quality articles. 
                </p>
                <p>
                    From technology and design to lifestyle and culture, we cover topics that matter. We strive to build a community where curiosity is rewarded and every voice has a chance to be heard.
                </p>
            </div>

            <hr class="border-gray-100 mb-12">

            <!-- Stats or Values Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="text-center p-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1">Quality Content</h3>
                    <p class="text-sm text-gray-500">Curated articles written with care.</p>
                </div>

                <div class="text-center p-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1">Community Driven</h3>
                    <p class="text-sm text-gray-500">Built by readers and writers alike.</p>
                </div>

                <div class="text-center p-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1">Always Growing</h3>
                    <p class="text-sm text-gray-500">New ideas and perspectives daily.</p>
                </div>
            </div>

            <!-- CTA -->
            <div class="bg-gray-50 rounded-xl p-8 text-center border border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Ready to share your story?</h3>
                <p class="text-gray-500 mb-6 text-sm">Join our community and start publishing today.</p>
                <div class="flex justify-center gap-3">
                    <a href="{{ route('post.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Read Articles
                    </a>
                    @auth
                        <a href="{{ route('post.create') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all">
                            Create Post
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all">
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

@endsection