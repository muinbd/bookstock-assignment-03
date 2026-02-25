@extends('layouts.layout')

@section('header')
<header class="bg-white shadow-sm">
    <div class="px-6 lg:px-8 py-4">
        <h1 class="text-xl font-bold text-gray-800">Create Author</h1>
        <p class="text-sm text-gray-500">Add a new author</p>
    </div>
</header>
@endsection

@section('content')

<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2"></div>

        <form action="{{ route('authors.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Name *
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            {{-- EMAIL --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Email *
    </label>
    <input type="email"
           name="email"
           value="{{ old('email') }}"
           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
    @error('email')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Bio
                </label>
                <textarea name="bio"
                          rows="3"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">{{ old('bio') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Status *
                </label>
                <select name="status"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4">

                <a href="{{ route('authors.index') }}"
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-600 hover:text-gray-800">
                    Cancel
                </a>

                <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg shadow-md">
                    Create Author
                </button>

            </div>

        </form>
    </div>
</div>

@endsection
