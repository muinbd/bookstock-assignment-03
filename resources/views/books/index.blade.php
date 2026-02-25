@extends('layouts.layout')

@section('header')
<header class="bg-white shadow-sm">
    <div class="px-6 lg:px-8 py-4 flex items-center justify-between">

        <div>
            <h1 class="text-xl font-bold text-gray-800">Books</h1>
            <p class="text-sm text-gray-500">Manage your book collection</p>
        </div>

        <a href="{{ route('books.create') }}"
           class="flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg shadow-md hover:from-indigo-700 hover:to-purple-700 transition">
            Add Book
        </a>
    </div>
</header>
@endsection

@section('content')

<div class="bg-white rounded-xl shadow overflow-hidden">
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2"></div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Cover</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Title</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Author</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Category</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">ISBN</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
            @forelse($books as $book)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}"
                                 class="w-12 h-16 object-cover rounded shadow-sm">
                        @else
                            <span class="text-gray-400 text-sm">No Image</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $book->title }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $book->author_name }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $book->category_name }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $book->isbn }}
                    </td>

                    <td class="px-6 py-4">
                        @if($book->status === 'available')
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Available
                            </span>
                        @elseif($book->status === 'borrowed')
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Borrowed
                            </span>
                        @else
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                Reserved
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">

                            <a href="{{ route('books.edit', $book->id) }}"
                               class="text-indigo-600 hover:text-indigo-800">
                                Edit
                            </a>

                            <form action="{{ route('books.destroy', $book->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')

                                <button class="text-red-600 hover:text-red-800">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-10 text-gray-400">
                        No books found.
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>
    </div>
</div>

@endsection
