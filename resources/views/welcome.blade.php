<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-cyan-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-200">
        <div class="relative px-4 py-16 sm:px-6 sm:py-24 lg:py-32 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <!-- Hero Section -->
                <div class="mb-16">
                    <div class="flex justify-center mb-8">
                        <div class="rounded-full bg-indigo-600 dark:bg-indigo-500 p-6 transition-colors duration-200">
                            <span class="text-4xl text-white">✅</span>
                        </div>
                    </div>
                    
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-6xl mb-6 transition-colors duration-200">
                        Gestor de Tarefas
                    </h1>
                    
                    <p class="text-xl leading-8 text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto transition-colors duration-200">
                        Organize as suas atividades diárias de forma simples e eficiente. 
                        Crie, gerencie e complete tarefas com uma interface moderna e intuitiva.
                    </p>

                    @guest
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('register') }}" 
                               class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                                <span>Começar Agora</span>
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                            
                            <a href="{{ route('login') }}" 
                               class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-indigo-600 bg-white border border-indigo-300 rounded-md hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                                Já tenho conta
                            </a>
                        </div>
                    @else
                        <div>
                            <a href="{{ route('tasks.index') }}" 
                               class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                                <span>Ver Minhas Tarefas</span>
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        </div>
                    @endguest
                </div>

                <!-- Features Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                    <div class="text-center p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 transition-colors duration-200">
                        <div class="mx-auto w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-4 transition-colors duration-200">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 transition-colors duration-200">Criar Tarefas</h3>
                        <p class="text-gray-600 dark:text-gray-300 transition-colors duration-200">Adicione tarefas com título, descrição, prioridade e data de vencimento.</p>
                    </div>

                    <div class="text-center p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 transition-colors duration-200">
                        <div class="mx-auto w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mb-4 transition-colors duration-200">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 transition-colors duration-200">Filtros Avançados</h3>
                        <p class="text-gray-600 dark:text-gray-300 transition-colors duration-200">Filtre por estado, prioridade, data ou pesquise por título específico.</p>
                    </div>

                    <div class="text-center p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 transition-colors duration-200">
                        <div class="mx-auto w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mb-4 transition-colors duration-200">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 transition-colors duration-200">Controlo Total</h3>
                        <p class="text-gray-600 dark:text-gray-300 transition-colors duration-200">Marque como concluída, edite ou elimine tarefas com facilidade.</p>
                    </div>
                </div>

                <!-- Technology Stack -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-8 transition-colors duration-200">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 transition-colors duration-200">Construído com Tecnologias Modernas</h2>
                    <div class="flex flex-wrap justify-center items-center gap-8 text-gray-600 dark:text-gray-300 transition-colors duration-200">
                        <div class="flex items-center space-x-2">
                            <span class="font-semibold">Laravel 12</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-semibold">Tailwind CSS</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-semibold">MySQL</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-semibold">Jetstream</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-semibold">Dark Mode</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
           