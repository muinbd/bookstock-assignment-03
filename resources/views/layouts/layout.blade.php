<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookStock | Interactive Cares</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        indigo: {
                            50: "#eef2ff",
                            100: "#e0e7ff",
                            500: "#6366f1",
                            600: "#4f46e5",
                            700: "#4338ca",
                        },
                        purple: {
                            500: "#a855f7",
                            600: "#9333ea",
                            700: "#7e22ce",
                        },
                    },
                },
            },
        };
    </script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");

        body {
            font-family: "Inter", sans-serif;
        }

        .sidebar-link {
            transition: all 0.2s ease;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: #f3f4f6;
            border-left: 4px solid #4f46e5;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">

<div class="flex flex-col lg:flex-row min-h-screen">

    <!-- Sidebar -->
    <aside class="lg:w-64 bg-white shadow-lg lg:h-screen lg:sticky lg:top-0">

        <!-- Logo -->
        <div class="p-6 border-b">
            <h1 class="font-bold text-lg text-indigo-600">
                BookStock
            </h1>
            <p class="text-xs text-gray-500">Interactive Cares</p>
        </div>

        <!-- Navigation -->
        <div class="p-4">
            <nav class="space-y-1">

                <!-- Dashboard (Books Landing) -->
                <a href="{{ route('books.index') }}"
                   class="flex items-center space-x-3 p-3 rounded-lg sidebar-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                    <span class="font-medium">Dashboard</span>
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Book Management
                    </p>
                </div>

                <!-- Categories -->
                <a href="{{ route('categories.index') }}"
                   class="flex items-center space-x-3 p-3 rounded-lg sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <span class="font-medium">Categories</span>
                </a>

                <!-- Authors -->
                <a href="{{ route('authors.index') }}"
                   class="flex items-center space-x-3 p-3 rounded-lg sidebar-link {{ request()->routeIs('authors.*') ? 'active' : '' }}">
                    <span class="font-medium">Authors</span>
                </a>

                <!-- Books -->
                <a href="{{ route('books.index') }}"
                   class="flex items-center space-x-3 p-3 rounded-lg sidebar-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                    <span class="font-medium">Books</span>
                </a>

            </nav>
        </div>

    </aside>


    <!-- Main Content -->
    <main class="flex-1 p-6 lg:p-8">

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-6 px-4 py-3 rounded-lg bg-green-50 border border-green-200 text-green-700 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-red-700 shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </main>

</div>

</body>
</html>
