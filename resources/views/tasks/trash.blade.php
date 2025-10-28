<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    🗑️ Lixo
                </h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                    Tarefas eliminadas (podem ser restauradas ou eliminadas permanentemente)
                </p>
            </div>
            <a href="{{ route('tasks.index') }}" 
               class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Voltar às Tarefas
            </a>
        </div>

        <!-- Alertas -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Lista de tarefas eliminadas -->
        @if($tasks->count() > 0)
            <div class="bg-white dark:bg-gray-700 shadow-sm rounded-lg border border-gray-200 dark:border-gray-600">
                <div class="divide-y divide-gray-200 dark:divide-gray-600">
                    @foreach($tasks as $task)
                        <div class="p-6 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500">
                            <div class="flex items-start justify-between">
                                <!-- Conteúdo da tarefa -->
                                <div class="flex items-start flex-1">
                                    <div class="flex-1 min-w-0">
                                        <!-- Título -->
                                        <h3 class="text-lg font-medium text-red-900 dark:text-red-100 line-through">
                                            {{ $task->title }}
                                        </h3>

                                        <!-- Descrição -->
                                        @if($task->description)
                                            <p class="mt-1 text-sm text-red-700 dark:text-red-200 line-through">
                                                {{ Str::limit($task->description, 100) }}
                                            </p>
                                        @endif

                                        <!-- Meta informações -->
                                        <div class="mt-2 flex flex-wrap items-center gap-3 text-xs">
                                            <!-- Prioridade -->
                                            <span class="inline-flex items-center px-2 py-1 rounded-full {{ $task->priority_color }} opacity-60">
                                                {{ $task->priority_label }}
                                            </span>

                                            <!-- Data de eliminação -->
                                            <span class="text-red-600 dark:text-red-400 font-medium">
                                                <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Eliminada em {{ $task->deleted_at->format('d/m/Y H:i') }}
                                            </span>

                                            <!-- Data de criação -->
                                            <span class="text-gray-500 dark:text-gray-400">
                                                Criada em {{ $task->created_at->format('d/m/Y H:i') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ações -->
                                <div class="flex items-center space-x-2 ml-4">
                                    <!-- Restaurar -->
                                    <form action="{{ route('tasks.restore', $task->id) }}" method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" 
                                                class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300" 
                                                title="Restaurar tarefa"
                                                onclick="return confirm('Tem certeza que deseja restaurar esta tarefa?')">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                            </svg>
                                        </button>
                                    </form>

                                    <!-- Eliminar permanentemente -->
                                    <form action="{{ route('tasks.force-delete', $task->id) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('⚠️ ATENÇÃO: Esta ação é irreversível!\n\nTem certeza que deseja eliminar permanentemente esta tarefa?\n\nEla não poderá ser recuperada.')">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-200" 
                                                title="Eliminar permanentemente">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Paginação -->
            <div class="mt-6">
                {{ $tasks->links() }}
            </div>
        @else
            <!-- Estado vazio -->
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 p-12 text-center">
                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Lixo vazio</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    Não tem tarefas eliminadas no momento.
                </p>
                <a href="{{ route('tasks.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Voltar às Tarefas
                </a>
            </div>
        @endif

        <!-- Aviso sobre eliminação permanente -->
        @if($tasks->count() > 0)
            <div class="mt-6 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-md p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Informação Importante</h3>
                        <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                            <p>• <strong>Restaurar:</strong> A tarefa voltará à lista normal e poderá ser editada normalmente</p>
                            <p>• <strong>Eliminar permanentemente:</strong> A tarefa será apagada para sempre e não poderá ser recuperada</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>