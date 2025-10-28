<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    ✅ Gestor de Tarefas
                </h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                    Organize as suas atividades diárias de forma eficiente
                </p>
            </div>
            <a href="{{ route('tasks.create') }}" 
               class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nova Tarefa
            </a>
        </div>

        <!-- Filtros -->
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 p-6 mb-6">
            <form method="GET" action="{{ route('tasks.index') }}" class="space-y-4 md:space-y-0 md:grid md:grid-cols-7 md:gap-4">
                <!-- Pesquisa -->
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Pesquisar</label>
                    <input type="text" 
                           name="search" 
                           id="search"
                           value="{{ request('search') }}"
                           placeholder="Procurar por título..."
                           class="w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Estado -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Estado</label>
                    <select name="status" id="status" class="w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Ativas (não concluídas)</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pendentes</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Concluídas</option>
                        <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>Todas (incluindo concluídas)</option>
                    </select>
                </div>

                <!-- Prioridade -->
                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Prioridade</label>
                    <select name="priority" id="priority" class="w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Todas</option>
                        <option value="alta" {{ request('priority') === 'alta' ? 'selected' : '' }}>Alta</option>
                        <option value="media" {{ request('priority') === 'media' ? 'selected' : '' }}>Média</option>
                        <option value="baixa" {{ request('priority') === 'baixa' ? 'selected' : '' }}>Baixa</option>
                    </select>
                </div>

                <!-- Data de vencimento -->
                <div>
                    <label for="due_date_filter" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Vencimento</label>
                    <select name="due_date_filter" id="due_date_filter" class="w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Todas</option>
                        <option value="overdue" {{ request('due_date_filter') === 'overdue' ? 'selected' : '' }}>Em atraso</option>
                        <option value="today" {{ request('due_date_filter') === 'today' ? 'selected' : '' }}>Hoje</option>
                        <option value="this_week" {{ request('due_date_filter') === 'this_week' ? 'selected' : '' }}>Esta semana</option>
                    </select>
                </div>

                <!-- Ordenação -->
                <div>
                    <label for="sort" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Ordenar por</label>
                    <select name="sort" id="sort" class="w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="created_at_desc" {{ request('sort') === 'created_at_desc' ? 'selected' : '' }}>Mais recentes</option>
                        <option value="created_at_asc" {{ request('sort') === 'created_at_asc' ? 'selected' : '' }}>Mais antigas</option>
                        <option value="due_date_asc" {{ request('sort') === 'due_date_asc' ? 'selected' : '' }}>Vencimento (próximo)</option>
                        <option value="due_date_desc" {{ request('sort') === 'due_date_desc' ? 'selected' : '' }}>Vencimento (distante)</option>
                        <option value="priority_desc" {{ request('sort') === 'priority_desc' ? 'selected' : '' }}>Prioridade (alta → baixa)</option>
                        <option value="priority_asc" {{ request('sort') === 'priority_asc' ? 'selected' : '' }}>Prioridade (baixa → alta)</option>
                        <option value="title_asc" {{ request('sort') === 'title_asc' ? 'selected' : '' }}>Título (A → Z)</option>
                        <option value="title_desc" {{ request('sort') === 'title_desc' ? 'selected' : '' }}>Título (Z → A)</option>
                    </select>
                </div>

                <!-- Botões -->
                <div class="flex items-center space-x-2">
                    <button type="submit" class="inline-flex items-center justify-center px-3 py-2 bg-gray-600 text-white text-sm rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Filtrar
                    </button>
                    <a href="{{ route('tasks.index') }}" class="inline-flex items-center justify-center px-3 py-2 bg-gray-300 dark:bg-gray-500 text-gray-700 dark:text-white text-sm rounded-md hover:bg-gray-400 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Limpar
                    </a>
                </div>
            </form>
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

        <!-- Título da Vista Atual -->
        <div class="mb-6">
            <div class="flex items-center">
                @if(request('status') === 'completed')
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">✅ Tarefas Concluídas</h2>
                @elseif(request('status') === 'pending')
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">⏳ Tarefas Pendentes</h2>
                @elseif(request('due_date_filter') === 'overdue')
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">⚠️ Tarefas em Atraso</h2>
                @elseif(request('status') === 'all')
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">📋 Todas as Tarefas</h2>
                @else
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">⚡ Tarefas Ativas</h2>
                @endif
                <span class="ml-auto text-sm text-gray-500 dark:text-gray-400">
                    {{ $tasks->total() }} {{ $tasks->total() === 1 ? 'tarefa' : 'tarefas' }}
                </span>
            </div>
            <div class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                @if(request('status') === 'completed')
                    Tarefas que já foram marcadas como concluídas
                @elseif(request('status') === 'pending')
                    Tarefas não concluídas que ainda não estão em atraso
                @elseif(request('due_date_filter') === 'overdue')
                    Tarefas que passaram da data de vencimento e ainda não foram concluídas
                @elseif(request('status') === 'all')
                    Todas as suas tarefas, incluindo concluídas e ativas
                @else
                    Tarefas que precisam da sua atenção (pendentes e em atraso)
                @endif
            </div>
        </div>

        <!-- Lista de tarefas -->
        @if($tasks->count() > 0)
            <div class="bg-white dark:bg-gray-700 shadow-sm rounded-lg border border-gray-200 dark:border-gray-600">
                <div class="divide-y divide-gray-200 dark:divide-gray-600">
                    @foreach($tasks as $task)
                        <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150">
                            <div class="flex items-start justify-between">
                                <!-- Conteúdo da tarefa -->
                                <div class="flex items-start flex-1">
                                    <div class="flex-1 min-w-0">
                                        <!-- Título -->
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                            {{ $task->title }}
                                        </h3>

                                        <!-- Descrição -->
                                        @if($task->description)
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                                {{ Str::limit($task->description, 100) }}
                                            </p>
                                        @endif

                                        <!-- Meta informações -->
                                        <div class="mt-2 flex flex-wrap items-center gap-3 text-xs">
                                            <!-- Prioridade -->
                                            <span class="inline-flex items-center px-2 py-1 rounded-full {{ $task->priority_color }}">
                                                {{ $task->priority_label }}
                                            </span>

                                            <!-- Data de vencimento -->
                                            @if($task->due_date)
                                                <span class="inline-flex items-center text-gray-500">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    {{ $task->due_date_formatted }}
                                                    @if($task->is_overdue)
                                                        <span class="ml-1 text-red-600 dark:text-red-400 font-medium">(Em atraso)</span>
                                                    @endif
                                                </span>
                                            @endif

                                            <!-- Data de criação -->
                                            <span class="text-gray-400 dark:text-gray-500">
                                                Criada em {{ $task->created_at->format('d/m/Y H:i') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ações -->
                                <div class="flex items-center space-x-2 ml-4">
                                    <!-- Botão para completar/descompletar -->
                                    <form action="{{ route('tasks.toggle-complete', $task) }}" method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" 
                                                class="{{ $task->is_completed ? 'text-green-500 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300' : 'text-gray-400 hover:text-green-600 dark:text-gray-500 dark:hover:text-green-400' }}" 
                                                title="{{ $task->is_completed ? 'Marcar como pendente' : 'Marcar como concluída' }}">
                                            @if($task->is_completed)
                                                <!-- Ícone de tarefa concluída -->
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                            @else
                                                <!-- Ícone para completar -->
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @endif
                                        </button>
                                    </form>

                                    <a href="{{ route('tasks.show', $task) }}" 
                                       class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300" 
                                       title="Ver detalhes">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    <a href="{{ route('tasks.edit', $task) }}" 
                                       class="text-indigo-400 hover:text-indigo-600 dark:text-indigo-300 dark:hover:text-indigo-200" 
                                       title="Editar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>

                                    <form action="{{ route('tasks.destroy', $task) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Tem certeza que deseja eliminar esta tarefa?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-400 hover:text-red-600 dark:text-red-300 dark:hover:text-red-200" 
                                                title="Eliminar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Nenhuma tarefa encontrada</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    @if(request()->hasAny(['search', 'status', 'priority', 'due_date_filter']))
                        Não existem tarefas que correspondam aos filtros selecionados.
                    @elseif(!request()->filled('status'))
                        Não tem tarefas ativas no momento. Todas as suas tarefas estão concluídas!
                        <br><small class="text-gray-500">Para ver tarefas concluídas, use o filtro "Concluídas" na sidebar ou no filtro acima.</small>
                    @else
                        Comece por criar a sua primeira tarefa para organizar as suas atividades.
                    @endif
                </p>
                <a href="{{ route('tasks.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Criar Primeira Tarefa
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
