<template>
    <Layout>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="mb-8">
                <div
                    class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2"
                >
                    <Link
                        href="/tasks"
                        class="hover:text-gray-700 dark:hover:text-gray-300"
                        >Tarefas</Link
                    >
                    <span>/</span>
                    <span class="text-gray-900 dark:text-white"
                        >Nova Tarefa</span
                    >
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    <span v-if="duplicateTask">📋 Duplicar Tarefa</span>
                    <span v-else>✨ Criar Nova Tarefa</span>
                </h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                    <span v-if="duplicateTask">
                        Criar uma nova tarefa baseada em "{{
                            truncateText(duplicateTask.title, 40)
                        }}"
                    </span>
                    <span v-else>
                        Adicione uma nova tarefa ao seu gestor de atividades
                    </span>
                </p>
            </div>

            <!-- Formulário -->
            <div
                class="bg-white dark:bg-gray-700 shadow-sm rounded-lg border border-gray-200 dark:border-gray-600 transition-colors duration-200"
            >
                <form @submit.prevent="submitForm" class="p-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Título -->
                        <div class="sm:col-span-2">
                            <label
                                for="title"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2"
                            >
                                Título <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                v-model="form.title"
                                id="title"
                                required
                                :class="[
                                    'w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
                                    form.errors.title ? 'border-red-300' : '',
                                ]"
                                placeholder="Ex: Terminar relatório mensal"
                            />
                            <p
                                v-if="form.errors.title"
                                class="mt-1 text-sm text-red-600 dark:text-red-400"
                            >
                                {{ form.errors.title }}
                            </p>
                        </div>

                        <!-- Prioridade -->
                        <div>
                            <label
                                for="priority"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2"
                            >
                                Prioridade <span class="text-red-500">*</span>
                            </label>
                            <select
                                v-model="form.priority"
                                id="priority"
                                required
                                :class="[
                                    'w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
                                    form.errors.priority
                                        ? 'border-red-300'
                                        : '',
                                ]"
                            >
                                <option value="">Selecione a prioridade</option>
                                <option value="alta">🔴 Alta</option>
                                <option value="media">🟡 Média</option>
                                <option value="baixa">🟢 Baixa</option>
                            </select>
                            <p
                                v-if="form.errors.priority"
                                class="mt-1 text-sm text-red-600 dark:text-red-400"
                            >
                                {{ form.errors.priority }}
                            </p>
                        </div>

                        <!-- Data de vencimento -->
                        <div>
                            <label
                                for="due_date"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2"
                            >
                                📅 Data de Vencimento
                            </label>
                            <input
                                type="date"
                                v-model="form.due_date"
                                id="due_date"
                                :min="today"
                                :class="[
                                    'w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
                                    form.errors.due_date
                                        ? 'border-red-300'
                                        : '',
                                ]"
                                style="color-scheme: light"
                            />
                            <p
                                v-if="form.errors.due_date"
                                class="mt-1 text-sm text-red-600 dark:text-red-400"
                            >
                                {{ form.errors.due_date }}
                            </p>
                            <p
                                class="mt-1 text-xs text-gray-500 dark:text-gray-400"
                            >
                                Opcional. Deixe em branco se não tem prazo
                                específico.
                            </p>
                        </div>

                        <!-- Descrição -->
                        <div class="sm:col-span-2">
                            <label
                                for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2"
                            >
                                Descrição
                            </label>
                            <textarea
                                v-model="form.description"
                                id="description"
                                rows="4"
                                :class="[
                                    'w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
                                    form.errors.description
                                        ? 'border-red-300'
                                        : '',
                                ]"
                                placeholder="Descreva os detalhes da tarefa (opcional)..."
                            ></textarea>
                            <p
                                v-if="form.errors.description"
                                class="mt-1 text-sm text-red-600 dark:text-red-400"
                            >
                                {{ form.errors.description }}
                            </p>
                            <p
                                class="mt-1 text-xs text-gray-500 dark:text-gray-400"
                            >
                                Adicione detalhes adicionais sobre o que precisa
                                ser feito.
                            </p>
                        </div>
                    </div>

                    <!-- Botões de ação -->
                    <div
                        class="mt-8 flex flex-col sm:flex-row sm:justify-end sm:space-x-3 space-y-3 sm:space-y-0"
                    >
                        <Link
                            href="/tasks"
                            class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-white uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                        >
                            Cancelar
                        </Link>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150"
                        >
                            <svg
                                class="w-4 h-4 mr-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                ></path>
                            </svg>
                            <span v-if="form.processing">Criando...</span>
                            <span v-else>Criar Tarefa</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Dicas -->
            <div
                class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md p-4"
            >
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg
                            class="h-5 w-5 text-blue-400 dark:text-blue-300"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3
                            class="text-sm font-medium text-blue-800 dark:text-blue-200"
                        >
                            Dicas para organizar melhor as suas tarefas
                        </h3>
                        <div
                            class="mt-2 text-sm text-blue-700 dark:text-blue-300"
                        >
                            <ul class="list-disc list-inside space-y-1">
                                <li>Use títulos claros e específicos</li>
                                <li>Defina prioridades realistas</li>
                                <li>
                                    Adicione prazos para tarefas importantes
                                </li>
                                <li>
                                    Descreva os passos necessários na descrição
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import { computed, onMounted } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";

// Props
const props = defineProps({
    duplicateTask: {
        type: Object,
        default: null,
    },
});

// Form usando Inertia's useForm
const form = useForm({
    title: "",
    description: "",
    due_date: "",
    priority: "",
});

// Computed properties
const today = computed(() => {
    const today = new Date();
    return today.toISOString().split("T")[0];
});

// Methods
const submitForm = () => {
    form.post("/tasks", {
        onSuccess: () => {
            // Inertia will redirect automatically
        },
    });
};

const truncateText = (text, length) => {
    if (!text || text.length <= length) return text;
    return text.substring(0, length) + "...";
};

// Initialize form with duplicate task data if provided
onMounted(() => {
    if (props.duplicateTask) {
        form.title = props.duplicateTask.title;
        form.description = props.duplicateTask.description || "";
        form.due_date = props.duplicateTask.due_date || "";
        form.priority = props.duplicateTask.priority || "";
    }
});
</script>

<style scoped>
/* Custom styling for date input in dark mode */
input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(0) brightness(0) saturate(100%) invert(55%) sepia(8%)
        saturate(328%) hue-rotate(181deg) brightness(89%) contrast(87%);
    cursor: pointer;
}

.dark input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(0) brightness(0) saturate(100%) invert(55%) sepia(8%)
        saturate(328%) hue-rotate(181deg) brightness(89%) contrast(87%);
}
</style>
