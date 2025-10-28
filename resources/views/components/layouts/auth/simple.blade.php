<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-cyan-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 antialiased transition-colors duration-200">
        <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="w-full max-w-md">
                <!-- Branding Header -->
                <div class="text-center mb-8">
                    <a href="{{ route('home') }}" class="inline-block" wire:navigate>
                        <div class="flex items-center justify-center mb-4">
                            <div class="rounded-full bg-indigo-600 dark:bg-indigo-500 p-4 transition-colors duration-200">
                                <span class="text-3xl text-white">✅</span>
                            </div>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white transition-colors duration-200">
                            To-Do App
                        </h1>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1 transition-colors duration-200">
                            Gestor de Tarefas
                        </p>
                    </a>
                </div>

                <!-- Auth Form Container -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 p-8 transition-colors duration-200">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
