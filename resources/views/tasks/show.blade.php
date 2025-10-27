<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                <a href="{{ route('tasks.index') }}" class="hover:text-gray-700 dark:hover:text-gray-300">Tarefas</a>
                <span>/</span>
                <span class="text-gray-900 dark:text-white">{{ Str::limit($task->title, 50) }}</span>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between">
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white {{ $task->is_completed ? 'line-through text-gray-500 dark:text-gray-400' : '' }}">
                        {{ $task->title }}
                    </h1>
                    @if($task->description)
                        <p class="mt-2 text-lg text-gray-600 dark:text-gray-300 {{ $task->is_completed ? 'line-through' : '' }}">
                            {{ $task->description }}
                        </p>
                    @endif
                </div>

                <!-- Ações rápidas -->
                <div class="mt-4 sm:mt-0 sm:ml-6 flex flex-col sm:flex-row gap-3">
                    <!-- Toggle de conclusão -->
                    <form action="{{ route('tasks.toggle-complete', $task) }}" method="POST" class="inline">
                        @csrf @method('PATCH')
                        <button type="submit" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 {{ $task->is_completed ? 'bg-gray-600 hover:bg-gray-700' : 'bg-green-600 hover:bg-green-700' }} border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                            @if($task->is_completed)
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                                </svg>
                                Marcar Pendente
                            @else
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Marcar Concluída
                            @endif
                        </button>
                    </form>

                    <a href="{{ route('tasks.edit', $task) }}" 
                       class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Editar
                    </a>
                </div>
            </div>
        </div>

        <!-- Alertas -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-md p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400 dark:text-green-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-800 dark:text-green-200">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Detalhes principais -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-700 shadow-sm rounded-lg border border-gray-200 dark:border-gray-600 p-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Detalhes da Tarefa</h2>
                    
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Estado -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Estado</dt>
                            <dd>
                                @if($task->is_completed)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Concluída
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        Pendente
                                    </span>
                                @endif
                            </dd>
                        </div>

                        <!-- Prioridade -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Prioridade</dt>
                            <dd>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $task->priority_color }}">
                                    @if($task->priority === 'alta')
                                        🔴
                                    @elseif($task->priority === 'media')
                                        🟡
                                    @else
                                        🟢
                                    @endif
                                    {{ $task->priority_label }}
                                </span>
                            </dd>
                        </div>

                        <!-- Data de vencimento -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Data de Vencimento</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">
                                @if($task->due_date)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $task->due_date_formatted }}
                                        @if($task->is_overdue)
                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                                                Em atraso
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-gray-400 dark:text-gray-500 italic">Sem prazo definido</span>
                                @endif
                            </dd>
                        </div>

                        <!-- Data de criação -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Criada em</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">
                                {{ $task->created_at->format('d/m/Y \à\s H:i') }}
                            </dd>
                        </div>

                        @if($task->updated_at != $task->created_at)
                            <!-- Última atualização -->
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Última atualização</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">
                                    {{ $task->updated_at->format('d/m/Y \à\s H:i') }}
                                    <span class="text-gray-400 dark:text-gray-500">
                                        ({{ $task->updated_at->diffForHumans() }})
                                    </span>
                                </dd>
                            </div>
                        @endif
                    </dl>
                </div>

                @if($task->description)
                    <!-- Descrição completa -->
                    <div class="mt-6 bg-white dark:bg-gray-700 shadow-sm rounded-lg border border-gray-200 dark:border-gray-600 p-6">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Descrição Completa</h2>
                        <div class="prose max-w-none">
                            <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $task->description }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar com ações -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-700 shadow-sm rounded-lg border border-gray-200 dark:border-gray-600 p-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Ações Rápidas</h2>
                    
                    <div class="space-y-3">
                        <!-- Editar -->
                        <a href="{{ route('tasks.edit', $task) }}" 
                           class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Editar Tarefa
                        </a>

                        <!-- Duplicar (criar nova baseada nesta) -->
                        <a href="{{ route('tasks.create', ['duplicate' => $task->id]) }}" 
                           class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            Duplicar Tarefa
                        </a>

                        <!-- Voltar à lista -->
                        <a href="{{ route('tasks.index') }}" 
                           class="w-full inline-flex justify-center items-center px-4 py-2 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-white uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Voltar à Lista
                        </a>

                        <!-- Eliminar -->
                        <form action="{{ route('tasks.destroy', $task) }}" 
                              method="POST" 
                              onsubmit="return confirm('Tem certeza que deseja eliminar esta tarefa? Esta ação não pode ser desfeita.')">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Eliminar Tarefa
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Dicas -->
                @if(!$task->is_completed && $task->is_overdue)
                    <div class="mt-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400 dark:text-red-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800 dark:text-red-200">Tarefa em atraso!</h3>
                                <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                                    <p>Esta tarefa já passou do prazo de vencimento. Considere atualizá-la ou marcá-la como concluída.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif(!$task->is_completed && $task->due_date && $task->due_date->isToday())
                    <div class="mt-6 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400 dark:text-yellow-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Vence hoje!</h3>
                                <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                                    <p>Esta tarefa vence hoje. Não se esqueça de a concluir.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>