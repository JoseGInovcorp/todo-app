<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'To‑Do App') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo/Brand -->
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="flex items-center space-x-2">
                            <span class="text-2xl">✅</span>
                            <span class="text-xl font-bold text-gray-900">{{ config('app.name', 'To‑Do App') }}</span>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    @auth
                        <div class="hidden md:flex items-center space-x-8">
                            <a href="{{ route('tasks.index') }}" 
                               class="flex items-center space-x-1 text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('tasks.*') ? 'text-indigo-600 bg-indigo-50' : '' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <span>Minhas Tarefas</span>
                            </a>
                        </div>

                        <!-- User Menu -->
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-600">Olá, {{ Auth::user()->name }}!</span>
                            
                            <!-- User Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" 
                                        class="flex items-center space-x-1 text-gray-700 hover:text-gray-900 focus:outline-none">
                                    <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white text-sm font-medium">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <div x-show="open" 
                                     @click.away="open = false"
                                     x-transition
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                                    <a href="{{ route('settings.profile') }}" 
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Perfil
                                    </a>
                                    <a href="{{ route('settings.password') }}" 
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Alterar Password
                                    </a>
                                    <hr class="my-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" 
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Terminar Sessão
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Guest Links -->
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('login') }}" 
                               class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">
                                Entrar
                            </a>
                            <a href="{{ route('register') }}" 
                               class="bg-indigo-600 text-white hover:bg-indigo-700 px-4 py-2 rounded-md text-sm font-medium">
                                Registar
                            </a>
                        </div>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" 
                                class="text-gray-700 hover:text-gray-900 focus:outline-none focus:text-gray-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                @auth
                    <div x-show="mobileMenuOpen" 
                         x-transition
                         class="md:hidden"
                         x-data="{ mobileMenuOpen: false }">
                        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 border-t border-gray-200">
                            <a href="{{ route('tasks.index') }}" 
                               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                                Minhas Tarefas
                            </a>
                            <a href="{{ route('settings.profile') }}" 
                               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                                Perfil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                                    Terminar Sessão
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </nav>

        <!-- Main Content -->
        <main>
            {{ $slot ?? '' }}
            @yield('content')
        </main>
    </div>

    <!-- Alpine.js for dropdowns -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
