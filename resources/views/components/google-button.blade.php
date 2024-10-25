<a href="{{ route('login.provider', 'google') }}" class="flex items-center justify-center gap-3 w-full p-3 text-black bg-white rounded-md font-medium text-md hover:shadow-md dark:bg-gray-900 dark:text-white dark:focus:bg-gray-800 focus:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 ease-in-out duration-150 border-gray-300 border-[1px] dark:border-gray-700 transition-all">
    <img src="{{ asset('google_logo.png') }}" alt="Google" class="w-5 h-5">
    {{ $slot }} with Google
</a>