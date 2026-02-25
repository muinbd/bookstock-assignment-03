@extends('layouts.layout')

@section('header')
<header class="bg-white shadow-sm">
    <div class="px-6 lg:px-8 py-4">
        <h1 class="text-xl font-bold text-gray-800">Create Book</h1>
        <p class="text-sm text-gray-500">Add a new book</p>
    </div>
</header>
@endsection

@section('content')

<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2"></div>

        <form action="{{ route('books.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-6 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                <input type="text" name="title"
                       value="{{ old('title') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ISBN *</label>
                <input type="text" name="isbn"
                       value="{{ old('isbn') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                @error('isbn')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Author *</label>
                    <select name="author_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <option value="">Select Author</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                    <select name="category_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                <select name="status"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="available">Available</option>
                    <option value="borrowed">Borrowed</option>
                    <option value="reserved">Reserved</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Published Date</label>
                <input type="date" name="published_at"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cover Image</label>
                <input type="file" name="cover_image"
                       class="w-full border border-gray-300 rounded-lg p-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description"
                          rows="3"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4">

                <a href="{{ route('books.index') }}"
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-600 hover:text-gray-800">
                    Cancel
                </a>

                <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg shadow-md">
                    Create Book
                </button>

            </div>

        </form>
    </div>
</div>

@endsection
