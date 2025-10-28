<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                <a href="{{ route('tasks.index') }}" class="hover:text-gray-700 dark:hover:text-gray-300">Tarefas</a>
                <span>/</span>
                <a href="{{ route('tasks.show', $task) }}" class="hover:text-gray-700 dark:hover:text-gray-300">{{ Str::limit($task->title, 30) }}</a>
                <span>/</span>
                <span class="text-gray-900 dark:text-white">Editar</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                ✏️ Editar Tarefa
            </h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                Atualize os detalhes da sua tarefa
            </p>
        </div>

        <!-- Formulário -->
        <div class="bg-white dark:bg-gray-700 shadow-sm rounded-lg border border-gray-200 dark:border-gray-600 transition-colors duration-200">
            <form action="{{ route('tasks.update', $task) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Título -->
                    <div class="sm:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Título <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title"
                               value="{{ old('title', $task->title) }}"
                               required
                               class="w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-300 @enderror"
                               placeholder="Ex: Terminar relatório mensal">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Prioridade -->
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Prioridade <span class="text-red-500">*</span>
                        </label>
                        <select name="priority" 
                                id="priority" 
                                required
                                class="w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('priority') border-red-300 @enderror">
                            <option value="">Selecione a prioridade</option>
                            <option value="alta" {{ old('priority', $task->priority) === 'alta' ? 'selected' : '' }}>
                                🔴 Alta
                            </option>
                            <option value="media" {{ old('priority', $task->priority) === 'media' ? 'selected' : '' }}>
                                🟡 Média
                            </option>
                            <option value="baixa" {{ old('priority', $task->priority) === 'baixa' ? 'selected' : '' }}>
                                🟢 Baixa
                            </option>
                        </select>
                        @error('priority')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Data de vencimento -->
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Data de Vencimento
                        </label>
                        <input type="date" 
                               name="due_date" 
                               id="due_date"
                               value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                               class="w-full rounded-md border-gray-300 dark:border-gray-500 bg-white dark:bg-gray-50 text-gray-900 dark:text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('due_date') border-red-300 @enderror"
                               style="color-scheme: light;"">
                        @error('due_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Opcional. Deixe em branco se não tem prazo específico.
                        </p>
                    </div>

                    <!-- Descrição -->
                    <div class="sm:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Descrição
                        </label>
                        <textarea name="description" 
                                  id="description"
                                  rows="4"
                                  class="w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-300 @enderror"
                                  placeholder="Descreva os detalhes da tarefa (opcional)...">{{ old('description', $task->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Adicione detalhes adicionais sobre o que precisa ser feito.
                        </p>
                    </div>
                </div>

                <!-- Botões de ação -->
                <div class="mt-8 flex flex-col sm:flex-row sm:justify-end sm:space-x-3 space-y-3 sm:space-y-0">
                    <a href="{{ route('tasks.index') }}" 
                       class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Guardar Alterações
                    </button>
                </div>
            </form>
        </div>

        <!-- Informações adicionais -->
        <div class="mt-6 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-gray-800 dark:text-gray-200">Informações da Tarefa</h3>
                    <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        <p><strong>Criada:</strong> {{ $task->created_at->format('d/m/Y \à\s H:i') }}</p>
                        @if($task->updated_at != $task->created_at)
                            <p><strong>Última atualização:</strong> {{ $task->updated_at->format('d/m/Y \à\s H:i') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
