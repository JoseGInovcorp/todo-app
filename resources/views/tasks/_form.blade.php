@csrf

<div class="mb-4">
    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
    <input type="text" name="title" id="title"
           value="{{ old('title', $task->title ?? '') }}"
           class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição</label>
    <textarea name="description" id="description" rows="3"
              class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">{{ old('description', $task->description ?? '') }}</textarea>
    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Data de Vencimento</label>
    <input type="date" name="due_date" id="due_date"
           value="{{ old('due_date', isset($task->due_date) ? $task->due_date->format('Y-m-d') : '') }}"
           class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
    @error('due_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prioridade</label>
    <select name="priority" id="priority"
            class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
        @foreach(['alta' => 'Alta', 'media' => 'Média', 'baixa' => 'Baixa'] as $value => $label)
            <option value="{{ $value }}" {{ old('priority', $task->priority ?? 'media') === $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('priority') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label class="inline-flex items-center">
        <input type="checkbox" name="is_completed" value="1"
               {{ old('is_completed', $task->is_completed ?? false) ? 'checked' : '' }}
               class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
        <span class="ml-2">Concluída</span>
    </label>
</div>

<div class="flex justify-end">
    <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Guardar
    </button>
</div>
