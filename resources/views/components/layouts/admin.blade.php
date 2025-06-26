<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">
    {{-- Wrapper --}}
    <div class="min-h-screen flex flex-col">
        {{-- Navbar/Header --}}
       

        {{-- Konten: Sidebar + Page Content --}}
        <div class="flex flex-1">
            {{-- Sidebar --}}
            <aside class="w-64 bg-white shadow-md">
                <nav class="p-4 space-y-2">
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Dashboard</a>
                    <a href="{{ route('admin.posts') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Posts</a>
                    <a href="{{ route('admin.categories.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Categories</a>
                    <a href="{{ route('admin.pages.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Pages</a>
                </nav>
            </aside>

            {{-- Main Content --}}
            <main class="flex-1 p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
