<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin CMS</title>
    @vite('resources/css/app.css')
    @livewireStyles
    
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto py-6">
        {{ $slot }}
    </div>
    @livewireScripts
    
    @vite('resources/js/app.js')
</body>
</html>
