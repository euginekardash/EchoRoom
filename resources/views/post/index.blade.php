@extends('layouts.main')
@section('content')
    <div>
        <div class="mb-3">
            <a href="{{ route('post.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 
              text-white font-medium text-sm rounded-lg shadow-sm hover:shadow-md 
              transition-all duration-200 ease-in-out 
              focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create
            </a>
        </div>
        @foreach ($posts as $post)
            <div>
                <a href="{{ route('post.show', $post->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                    {{ $post->id }}. {{ $post->title }}
                </a>
            </div>
        @endforeach
        <div class = "mt-3">
            {{$posts->links()}}
        </div>
    </div>
@endsection
