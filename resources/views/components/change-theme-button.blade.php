<!-- resources/views/components/change-theme-button.blade.php -->
<button id="theme-toggle" class="flex items-center gap-2 px-4 py-2 bg-gray-300 dark:bg-gray-600 text-black dark:text-white rounded absolute top-4 right-4">
    {{-- <svg id="theme-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8-9h-1m-16 0H3m15.364 6.364l-.707-.707m-11.314 0l-.707.707m15.364-15.364l-.707.707m-11.314 0l-.707-.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg> --}}
    <i id="theme-icon" class="fa-solid "></i> 
    {{-- <span id="theme-label"></span>  --}}
    {{-- <i class="fa-solid fa-moon"></i>
    <img src="{{ asset('icon/matahari.png') }}" alt="icon matahari" class="w-5 h-5"> --}}
</button>


<script>
    const themeToggle = document.getElementById('theme-toggle');
    const themeLabel = document.getElementById('theme-label');
    const themeIcon = document.getElementById('theme-icon');
    const currentTheme = localStorage.getItem('theme') || 'light';

    // Atur tema saat halaman pertama kali dibuka
    if (currentTheme === 'dark') {
        document.documentElement.classList.add('dark');
        // themeLabel.textContent = 'Light Mode';
        themeIcon.classList.add('fa-sun');
    } else {
        // themeLabel.textContent = 'Dark Mode';
        themeIcon.classList.add('fa-moon');
    }

    // Toggle tema dan simpan preferensi
    themeToggle.addEventListener('click', () => {
        const isDarkMode = document.documentElement.classList.toggle('dark');
        const newTheme = isDarkMode ? 'dark' : 'light';
        // themeLabel.textContent = isDarkMode ? 'Light Mode' : 'Dark Mode';
        themeIcon.classList.toggle('fa-sun');
        themeIcon.classList.toggle('fa-moon');
        localStorage.setItem('theme', newTheme);
    });
</script>
