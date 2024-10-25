<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SEWA LAPANGAN</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    @if (Route::has('login'))
        @auth
            @if (auth()->user()->role !== 'user')
                <a href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Dashboard
                </a>
            @else
            <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Kamu ingin log out?')">
                @csrf
    
                <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    {{ __('Log Out') }}
                </button>
            </form>
            @endif
            <p>Selamat Datang {{ auth()->user()->username }}</p>
            <img src="{{ auth()->user()->avatar }}" alt="">
        @else
            <a href="{{ route('login') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Log in
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Register
                </a>
            @endif
        @endauth
    @endif
    <h1 style="text-align: center">Selamat Datang di Sistem Sewa Lapangan</h1>
    <p> Jumlah lapangan : {{ $totalFields }}</p>
    @foreach ($fields as $field)
        <a href="{{ route('field.show', $field->id) }}" class="flex flex-col gap-2">
            <img src="{{ asset('storage/' . $field->image) }}" alt="{{ $field->image }}"
                style="aspect-ratio: 3/4; object-fit: contain; width: 300px;border-radius: 10px;border: 1px solid black">
            <h3 style="margin: 0">{{ $field->name }}</h3>
            <p style="margin: 3px 0 0 0; font-size: 0.8rem">Rp {{ number_format($field->price, 0, ',', '.') }} / Jam</p>
        </a>
    @endforeach
</body>

</html>
