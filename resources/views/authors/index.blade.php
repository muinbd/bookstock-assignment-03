@extends('layouts.layout')

@section('header')
<header class="bg-white shadow-sm">
    <div class="px-6 lg:px-8 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Authors</h1>
            <p class="text-sm text-gray-500">Manage your book authors</p>
        </div>

        <a href="{{ route('authors.create') }}"
           class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg shadow-md">
            + Add Author
        </a>
    </div>
</header>
@endsection

@section('content')

<div class="bg-white rounded-xl shadow overflow-hidden">
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2"></div>

    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Books Count</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

            @forelse($authors as $author)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 text-sm text-gray-600">
                        #{{ $author->id }}
                    </td>

                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $author->name }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $author->email }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $author->books_count }}
                    </td>

                    <td class="px-6 py-4">
                        @if($author->status === 'active')
                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                Active
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                Inactive
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">

                            <a href="{{ route('authors.edit', $author->id) }}"
                               class="text-indigo-600 hover:text-indigo-800">
                                ✏️
                            </a>

                            <form action="{{ route('authors.destroy', $author->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this author?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-800">
                                    🗑️
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-400">
                        No authors found.
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>

@endsection
