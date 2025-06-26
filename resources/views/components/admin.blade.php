<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white shadow-md">
            <div class="p-4 text-lg font-bold border-b">CMS Admin</div>
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.posts') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Posts</a>
                <a href="{{ route('admin.categories') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Categories</a>
                <a href="{{ route('admin.pages') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Pages</a>
            </nav>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>
