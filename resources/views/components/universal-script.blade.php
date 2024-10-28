{{-- font awesome --}}
<script src="https://kit.fontawesome.com/87dd173a0d.js" crossorigin="anonymous"></script>

{{-- Change Theme --}}
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