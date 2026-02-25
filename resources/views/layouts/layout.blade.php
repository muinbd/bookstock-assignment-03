<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStock | Interactive Cares</title>

    <script src="https://cdn.tailwindcss.com"></script>

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

    {{-- SIDEBAR --}}
    @include('partials.sidebar')

    {{-- MAIN CONTENT --}}
    <main class="flex-1 flex flex-col">

        {{-- PAGE HEADER --}}
        @yield('header')

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
            <div class="px-6 lg:px-8 mt-4">
                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="px-6 lg:px-8 mt-4">
                <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        {{-- PAGE CONTENT --}}
        <div class="flex-1 p-6 lg:p-8">
            @yield('content')
        </div>

    </main>

</div>

</body>
</html>
