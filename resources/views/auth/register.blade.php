@extends('layouts.guest')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div>
        <x-input-label for="username" :value="__('Name')" />
        <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('username')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- ROLE -->
    <div class="mt-4">
        {{-- <x-input-label for="role" :value="__('Role')" /> --}}
        <input type="text" name="role" id="role" value="user" hidden>
        {{-- <select name="role" id="role">  
            <option value="admin">Admin</option>
            <option value="owner">Owner</option>
            <option value="user">User</option> 
        </select> --}}
        {{-- <x-input-error :messages="$errors->get('role')" class="mt-2" /> --}}
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />

        <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                     autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="my-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation" autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>
    <x-google-button>{{ __('Sign up') }}</x-google-button>
    
    <div class="mt-4"> </div>
    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
        {{ __('Already registered?') }}
    </a>
    <div class="flex items-center justify-end mt-1">
        <x-primary-button>
            {{ __('Register') }}
        </x-primary-button>
    </div>
</form>
<x-change-theme-button />
@endsection
