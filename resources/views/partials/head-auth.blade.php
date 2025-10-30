<!-- Initialize theme immediately for auth pages -->
<script>
    // Apply theme before any content loads to prevent flash
    (function() {
        const theme = localStorage.getItem('theme') || 'light';
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        
        // Double-check after a small delay to ensure it sticks
        setTimeout(() => {
            const currentTheme = localStorage.getItem('theme') || 'light';
            const hasDarkClass = document.documentElement.classList.contains('dark');
            
            if (currentTheme === 'dark' && !hasDarkClass) {
                document.documentElement.classList.add('dark');
            } else if (currentTheme === 'light' && hasDarkClass) {
                document.documentElement.classList.remove('dark');
            }
        }, 50);
    })();
</script>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

{{-- Apenas CSS, sem JavaScript do Inertia --}}
@vite(['resources/css/app.css'])
@fluxAppearance

