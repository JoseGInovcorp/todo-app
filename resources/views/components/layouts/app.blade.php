@auth
    <x-layouts.app.sidebar :title="$title ?? null">
        <flux:main>
            {{ $slot }}
        </flux:main>
    </x-layouts.app.sidebar>
@else
    <!DOCTYPE html>
    <html lang="pt" class="">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? config('app.name', 'To‑Do App') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Initialize theme immediately -->
        <script>
            // Apply theme before any content loads
            (function() {
                const savedTheme = localStorage.getItem('theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const theme = savedTheme || (prefersDark ? 'dark' : 'light');
                
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            })();
        </script>
    </head>
    <body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased transition-colors duration-200">
        <div class="min-h-screen">
            <!-- Navbar -->
            <nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 transition-colors duration-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <!-- Logo/Brand -->
                        <div class="flex items-center">
                            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                                <span class="text-2xl">✅</span>
                                <div class="flex flex-col">
                                    <span class="text-xl font-bold text-gray-900 dark:text-white">{{ config('app.name', 'To‑Do App') }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Gestão de Tarefas</span>
                                </div>
                            </a>
                        </div>

                        <!-- Dark Mode Toggle & Guest Links -->
                        <div class="flex items-center space-x-4">
                            <!-- Theme Toggle Button -->
                            <button class="theme-toggle p-2 rounded-md text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200" 
                                    aria-label="Toggle dark mode">
                                <svg class="sun-icon w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <svg class="moon-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                </svg>
                            </button>

                            <a href="{{ route('login') }}" 
                               class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                Entrar
                            </a>
                            <a href="{{ route('register') }}" 
                               class="bg-indigo-600 dark:bg-indigo-500 text-white hover:bg-indigo-700 dark:hover:bg-indigo-600 px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                Registar
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Alpine.js for dropdowns -->
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </body>
    </html>
@endauth
