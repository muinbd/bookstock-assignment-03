@extends('layouts.layout')

@section('content')

<div class="max-w-xl mx-auto">

    <h2 class="text-xl font-bold text-gray-800 mb-6">
        Create Author
    </h2>

    <form action="{{ route('authors.store') }}" method="POST"
          class="bg-white p-6 shadow rounded-lg space-y-4">

        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Author Name <span class="text-red-500">*</span>
            </label>

            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">

            @error('name')
                <p class="text-red-600 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Biography
            </label>

            <textarea name="bio"
                      class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"
                      rows="4">{{ old('bio') }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Save
            </button>
        </div>

    </form>

</div>

@endsection
