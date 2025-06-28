<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navbar -->
        <livewire:layout.navigation />

        <div class="flex">
            <!-- Sidebar -->
            <div class="w-64 bg-white shadow-md min-h-screen">
                {{-- Kamu bisa pakai komponen atau hardcoded --}}
                <livewire:layout.sidebar />
            </div>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                @isset($header)
                    <header class="bg-white shadow mb-4">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
