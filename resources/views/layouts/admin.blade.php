<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen">
        {{-- Navbar / Sidebar --}}
        <header class="bg-white shadow p-4">
            <h1 class="text-xl font-bold">Admin Dashboard</h1>
        </header>

        <main class="p-6">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>
