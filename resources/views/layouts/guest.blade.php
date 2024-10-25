<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        {{-- <nav class="bg-gray-100 dark:bg-gray-800 p-4">
            <button id="theme-toggle" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 rounded">
                Toggle Theme
            </button>
        </nav> --}}
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <h1 class="text-5xl font-bold text-gray-900 dark:text-gray-100 transition ease-in-out duration-150">{{ $title }}</h1>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                @yield('content')
            </div>
        </div>
        
        {{-- <script>
            const themeToggle = document.getElementById('theme-toggle');
            const currentTheme = localStorage.getItem('theme') || 'light';
    
            if (currentTheme === 'dark') {
                document.documentElement.classList.add('dark');
            }
    
            themeToggle.addEventListener('click', () => {
                document.documentElement.classList.toggle('dark');
                const newTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
                localStorage.setItem('theme', newTheme);
            });
        </script> --}}
        <script src="https://kit.fontawesome.com/87dd173a0d.js" crossorigin="anonymous"></script>
    </body>
</html>
