<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800 transition-colors duration-200">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ Auth::check() ? route('dashboard') : url('/') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <div class="flex items-center space-x-2">
                    <span class="text-2xl">✅</span>
                    <div class="flex flex-col">
                        <span class="text-lg font-bold text-gray-900 dark:text-white">Todo-App</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Gestão de Tarefas</span>
                    </div>
                </div>
            </a>

            <flux:navlist variant="outline">
                @auth
                    <flux:navlist.group :heading="__('Gestão de Tarefas')" class="grid">
                        <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </flux:navlist.item>
                        
                        <flux:navlist.item icon="clipboard-document-list" :href="route('tasks.index')" :current="request()->routeIs('tasks.index')">
                            {{ __('Todas as Tarefas') }}
                        </flux:navlist.item>
                        
                        <flux:navlist.item icon="plus-circle" :href="route('tasks.create')" :current="request()->routeIs('tasks.create')">
                            {{ __('Nova Tarefa') }}
                        </flux:navlist.item>
                    </flux:navlist.group>
                    
                    <flux:navlist.group :heading="__('Filtros Rápidos')" class="grid">
                        <flux:navlist.item icon="clock" :href="route('tasks.index', ['status' => 'pending'])" :current="request()->get('status') === 'pending'">
                            {{ __('Pendentes') }}
                            <flux:badge size="sm" color="amber" class="ml-auto">
                                {{ Auth::user()->tasks()->pendingNotOverdue()->count() }}
                            </flux:badge>
                        </flux:navlist.item>
                        
                        <flux:navlist.item icon="check-circle" :href="route('tasks.index', ['status' => 'completed'])" :current="request()->get('status') === 'completed'">
                            {{ __('Concluídas') }}
                            <flux:badge size="sm" color="green" class="ml-auto">
                                {{ Auth::user()->tasks()->where('is_completed', true)->count() }}
                            </flux:badge>
                        </flux:navlist.item>
                        
                        <flux:navlist.item icon="exclamation-triangle" :href="route('tasks.index', ['due_date_filter' => 'overdue'])" :current="request()->get('due_date_filter') === 'overdue'">
                            {{ __('Em Atraso') }}
                            <flux:badge size="sm" color="red" class="ml-auto">
                                {{ Auth::user()->tasks()->overdue()->count() }}
                            </flux:badge>
                        </flux:navlist.item>
                        
                        <flux:navlist.item icon="trash" :href="route('tasks.trash')" :current="request()->routeIs('tasks.trash')">
                            {{ __('Lixo') }}
                            <flux:badge size="sm" color="gray" class="ml-auto">
                                {{ Auth::user()->tasks()->onlyTrashed()->count() }}
                            </flux:badge>
                        </flux:navlist.item>
                    </flux:navlist.group>
                @else
                    <flux:navlist.group :heading="__('Bem-vindo')" class="grid">
                        <flux:navlist.item icon="home" href="{{ url('/') }}" :current="request()->is('/')" wire:navigate>
                            {{ __('Página Inicial') }}
                        </flux:navlist.item>
                        
                        <flux:navlist.item icon="user-plus" :href="route('register')" :current="request()->routeIs('register')" wire:navigate>
                            {{ __('Registar') }}
                        </flux:navlist.item>
                        
                        <flux:navlist.item icon="arrow-right-end-on-rectangle" :href="route('login')" :current="request()->routeIs('login')" wire:navigate>
                            {{ __('Iniciar Sessão') }}
                        </flux:navlist.item>
                    </flux:navlist.group>
                @endauth
            </flux:navlist>

            <flux:spacer />

            <!-- Dark Mode Toggle -->
            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Tema')" class="grid">
                    <flux:navlist.item class="theme-toggle cursor-pointer" onclick="event.preventDefault()">
                        <div class="flex items-center justify-between w-full">
                            <span class="flex items-center">
                                <svg class="sun-icon w-5 h-5 mr-2 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <svg class="moon-icon w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                </svg>
                                <span class="dark-mode-text">{{ __('Modo Escuro') }}</span>
                                <span class="light-mode-text hidden">{{ __('Modo Claro') }}</span>
                            </span>
                        </div>
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Ajuda')" class="grid">
                    <flux:navlist.item icon="question-mark-circle" href="#" onclick="alert('Todo-App v0.8.0 - Sistema de gestão de tarefas pessoais com sidebar inteligente')" title="Sobre a aplicação">
                        {{ __('Sobre') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <!-- Desktop User Menu -->
            @if(Auth::check())
                <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                    <flux:profile
                        :name="auth()->user()->name"
                        :initials="auth()->user()->initials()"
                        icon:trailing="chevrons-up-down"
                    />

                    <flux:menu class="w-[220px]">
                        <flux:menu.radio.group>
                            <div class="p-0 text-sm font-normal">
                                <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                    <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                        <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                            {{ auth()->user()->initials() }}
                                        </span>
                                    </span>

                                    <div class="grid flex-1 text-start text-sm leading-tight">
                                        <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                        <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <flux:menu.radio.group>
                            <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                                {{ __('Settings') }}
                            </flux:menu.item>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                                {{ __('Log Out') }}
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            @else
                <div class="hidden lg:block px-4 py-2 text-sm text-gray-500">
                    {{ __('Visitante') }}
                </div>
            @endif
        </flux:sidebar>

        <!-- Mobile User Menu -->
        @if(Auth::check())
            <flux:header class="lg:hidden">
                <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
                <flux:spacer />

                <flux:dropdown position="top" align="end">
                    <flux:profile
                        :initials="auth()->user()->initials()"
                        icon-trailing="chevron-down"
                    />

                    <flux:menu>
                        <flux:menu.radio.group>
                            <div class="p-0 text-sm font-normal">
                                <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                    <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                        <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                            {{ auth()->user()->initials() }}
                                        </span>
                                    </span>

                                    <div class="grid flex-1 text-start text-sm leading-tight">
                                        <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                        <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <flux:menu.radio.group>
                            <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                                {{ __('Settings') }}
                            </flux:menu.item>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                                {{ __('Log Out') }}
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            </flux:header>
        @endif

        {{ $slot }}

        @fluxScripts
        
        <!-- Disable Livewire Progress Bar -->
        <style>
            /* Hide Livewire progress bar that causes flash during navigation */
            [x-data] [wire\:loading], 
            [x-data] [wire\:loading\.delay], 
            [x-data] [wire\:loading\.delay\.short], 
            [x-data] [wire\:loading\.delay\.long],
            div[wire\:loading],
            div[wire\:loading\.delay],
            div[wire\:loading\.delay\.short],
            div[wire\:loading\.delay\.long],
            /* Livewire navigate progress bar */
            div[data-turbo-progress-bar],
            [data-turbo-progress-bar],
            .livewire-progress-bar {
                display: none !important;
                opacity: 0 !important;
                visibility: hidden !important;
            }
        </style>
        
        <!-- Theme persistence during navigation -->
        <script>
            // Simple theme maintenance
            function maintainTheme() {
                const savedTheme = localStorage.getItem('theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const theme = savedTheme || (prefersDark ? 'dark' : 'light');
                
                if (theme === 'dark') {
                    if (!document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.add('dark');
                    }
                } else {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                    }
                }
                
                // Update toggle button if available
                if (window.themeManager) {
                    setTimeout(() => {
                        window.themeManager.updateToggleIcon(theme);
                    }, 50);
                }
            }
            
            // Apply on page load
            document.addEventListener('DOMContentLoaded', maintainTheme);
            
            // Apply after navigation
            document.addEventListener('livewire:navigated', maintainTheme);
            
            // Handle page visibility change
            document.addEventListener('visibilitychange', () => {
                if (!document.hidden) {
                    maintainTheme();
                }
            });
        </script>
    </body>
</html>
