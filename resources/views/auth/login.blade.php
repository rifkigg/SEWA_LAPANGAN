@extends('layouts.guest')

@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- @if ($errors->any())
        <div class="mb-4 text-red-600 border border-red-400 bg-red-200 rounded-md dark:text-red-400 dark:bg-gray-800 p-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Username or Email -->
        <div class="mt-4">
            <x-input-label for="login" :value="__('Username or Email')" />

            <x-text-input id="login" class="block mt-1 w-full" type="text" name="login" autofocus
                placeholder="Username or Email" />

            <!-- Menampilkan pesan error untuk login -->
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="my-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                autocomplete="current-password" placeholder="Password" />

            <!-- Menampilkan pesan error untuk password -->
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-google-button>{{ __('Sign in') }}</x-google-button>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            {{-- <div class="ms-4 flex justify-end items-center gap-1"> --}}
                <p class="m-0 text-sm text-gray-600 dark:text-gray-400">Don't have an account? <a href="{{ route('register') }}"
                class="underline text-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800">Register</a></p>
                
            {{-- </div> --}}
        </div>
        <div class="flex items-center justify-end mt-1">
            <x-primary-button>
                {{ __('Sign in') }}
            </x-primary-button>
        </div>
    </form>
    {{-- <a href="{{ route('login.provider', 'facebook') }}" class="btn btn-primary">Login with Facebook</a>
    <a href="{{ route('login.provider', 'github') }}" class="btn btn-dark">Login with GitHub</a> --}}
    <x-change-theme-button />
@endsection
