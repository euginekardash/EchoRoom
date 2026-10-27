@extends('layouts.main')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6 border border-gray-100">

        <form action="{{ route('post.update', $post->id) }}" method="POST">
            @csrf
            @method('patch')
            <div class="mb-5">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Title
                </label>
                <input type="text" id="title" name="title" placeholder="Enter your title here..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-900"
                    value="{{ $post->title }}">
            </div>
            <div class="mb-5">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    Content
                </label>
                <textarea id="content" name="content" placeholder="Enter your content here..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-900">{{ $post->content }}</textarea>
            </div>
            <div class="mb-5">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    Image
                </label>
                <input type="text" id="image" name="image" placeholder="Enter your image here..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-900"
                    value="{{ $post->image }}">
            </div>
            <div class="mb-5">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Category
                </label>
                <select id="category_id" name="category_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-900 bg-white">
                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select a category...</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-md transition-colors focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Update
            </button>
        </form>

    </div>
@endsection
