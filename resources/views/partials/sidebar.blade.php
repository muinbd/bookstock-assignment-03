<aside class="lg:w-64 bg-white shadow-lg lg:h-screen">

    <div class="p-6 border-b">
        <h1 class="font-bold text-lg text-indigo-600">
            BookStock
        </h1>
        <p class="text-xs text-gray-500">Interactive Cares</p>
    </div>

    <nav class="p-4 space-y-2">

        <a href="{{ route('books.index') }}"
           class="block p-3 rounded-lg sidebar-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
            Books
        </a>

        <a href="{{ route('authors.index') }}"
           class="block p-3 rounded-lg sidebar-link {{ request()->routeIs('authors.*') ? 'active' : '' }}">
            Authors
        </a>

        <a href="{{ route('categories.index') }}"
           class="block p-3 rounded-lg sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            Categories
        </a>

    </nav>

</aside>
