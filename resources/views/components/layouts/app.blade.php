<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        [x-cloak]{
            display: none;
        }
    </style>
</head>
<body>
<x-toast />
<div class="w-full min-h-screen">
    {{ $slot }}
</div>
</body>
@stack('scripts')
<!-- Coded by Omer Mohamed Ali for evo-ui -->
</html>
