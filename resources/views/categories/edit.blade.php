@extends('layouts.layout')

@section('header')
<header class="bg-white shadow-sm">
    <div class="px-6 lg:px-8 py-4">
        <h1 class="text-xl font-bold text-gray-800">Edit Category</h1>
        <p class="text-sm text-gray-500">Update category information</p>
    </div>
</header>
@endsection

@section('content')

<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2"></div>

        <form action="{{ route('categories.update', $category->id) }}"
              method="POST"
              class="p-6 space-y-6">
            @csrf
            @method('PUT')

            {{-- NAME --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Name *
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $category->name) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                </label>
                <textarea name="description"
                          rows="3"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">{{ old('description', $category->description) }}</textarea>
            </div>

            {{-- STATUS --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Status *
                </label>
                <select name="status"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="active"
                        {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="inactive"
                        {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>

            {{-- BUTTONS --}}
            <div class="flex items-center justify-end space-x-4 pt-4">

                <a href="{{ route('categories.index') }}"
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-600 hover:text-gray-800">
                    Cancel
                </a>

                <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg shadow-md">
                    Update Category
                </button>

            </div>

        </form>
    </div>
</div>

@endsection
