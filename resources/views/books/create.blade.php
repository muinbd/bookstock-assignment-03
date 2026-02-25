@extends('layouts.layout')

@section('content')

<div class="max-w-3xl mx-auto">

    <h2 class="text-xl font-bold text-gray-800 mb-6">
        Create Book
    </h2>

    <form action="{{ route('books.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white p-6 shadow rounded-lg space-y-4">

        @csrf

        <!-- Title -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Title *
            </label>
            <input type="text" name="title"
                   value="{{ old('title') }}"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
            @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- ISBN -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                ISBN *
            </label>
            <input type="text" name="isbn"
                   value="{{ old('isbn') }}"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
            @error('isbn')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Author -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Author *
            </label>
            <select name="author_id"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                <option value="">Select Author</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}"
                        {{ old('author_id') == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
            @error('author_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Category -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Category *
            </label>
            <select name="category_id"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Cover Image -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Cover Image
            </label>
            <input type="file" name="cover_image"
                   class="w-full border rounded-lg p-2">
            @error('cover_image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Description
            </label>
            <textarea name="description"
                      class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"
                      rows="4">{{ old('description') }}</textarea>
        </div>

        <!-- Published Date -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Published Date
            </label>
            <input type="date" name="published_at"
                   value="{{ old('published_at') }}"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Save Book
            </button>
        </div>

    </form>

</div>

@endsection
