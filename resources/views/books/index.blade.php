@extends('layouts.layout')

@section('content')

<!-- Books List Card -->
<div class="bg-white rounded-xl shadow overflow-hidden">

    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2"></div>

    <div class="p-6">

        <!-- Header + Add Button -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Books List
            </h2>

            <a href="{{ route('books.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                + Add Book
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full table-fixed">

                <thead class="bg-gray-50 border-b">
                    <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4 w-20">Cover</th>
                        <th class="px-6 py-4">Title</th>
                        <th class="px-6 py-4">Author</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4 w-32">ISBN</th>
                        <th class="px-6 py-4 w-36">Published</th>
                        <th class="px-6 py-4 w-32 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                @forelse($books as $book)
                    <tr class="hover:bg-gray-50 transition-colors">

                        <!-- Cover -->
                        <td class="px-6 py-4">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}"
                                     class="w-12 h-16 object-cover rounded-lg shadow-sm">
                            @else
                                <span class="text-gray-400 text-sm">No Image</span>
                            @endif
                        </td>

                        <!-- Title -->
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $book->title }}
                        </td>

                        <!-- Author -->
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $book->author_name }}
                        </td>

                        <!-- Category -->
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                {{ $book->category_name }}
                            </span>
                        </td>

                        <!-- ISBN -->
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $book->isbn }}
                        </td>

                        <!-- Published -->
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $book->published_at ?? '-' }}
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 text-right whitespace-nowrap">

                            <a href="{{ route('books.edit', $book->id) }}"
                               class="text-indigo-600 hover:underline mr-3">
                                Edit
                            </a>

                            <form action="{{ route('books.destroy', $book->id) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Are you sure you want to delete this book?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="text-red-600 hover:underline">
                                    Delete
                                </button>
                            </form>

                        </td>

                    </tr>

                @empty
                    <td colspan="7" class="text-center py-10 text-gray-400">
    No books found. Click "+ Add Book" to create one.
</td>
                    </tr>
                @endforelse

                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection
