<template>
    <Layout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8"
            >
                <div>
                    <h1
                        class="text-3xl font-bold text-gray-900 dark:text-white"
                    >
                        ✅ Gestor de Tarefas
                    </h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                        Organize as suas atividades diárias de forma eficiente
                    </p>
                </div>
                <Link
                    href="/tasks/create"
                    class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150"
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
                    Nova Tarefa
                </Link>
            </div>

            <!-- Filtros -->
            <div
                class="bg-white dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 p-6 mb-6"
            >
                <form
                    @submit.prevent="applyFilters"
                    class="space-y-4 lg:space-y-0 lg:grid lg:grid-cols-12 lg:gap-4"
                >
                    <!-- Pesquisa -->
                    <div class="lg:col-span-2">
                        <label
                            for="search"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1"
                            >Pesquisar</label
                        >
                        <input
                            type="text"
                            v-model="filters.search"
                            id="search"
                            placeholder="Procurar por título..."
                            class="w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        />
                    </div>

                    <!-- Estado -->
                    <div class="lg:col-span-2">
                        <label
                            for="status"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1"
                            >Estado</label
                        >
                        <select
                            v-model="filters.status"
                            id="status"
                            class="w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="">Ativas (não concluídas)</option>
                            <option value="pending">Pendentes</option>
                            <option value="completed">Concluídas</option>
                            <option value="all">
                                Todas (incluindo concluídas)
                            </option>
                        </select>
                    </div>

                    <!-- Prioridade -->
                    <div class="lg:col-span-2">
                        <label
                            for="priority"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1"
                            >Prioridade</label
                        >
                        <select
                            v-model="filters.priority"
                            id="priority"
                            class="w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="">Todas</option>
                            <option value="alta">Alta</option>
                            <option value="media">Média</option>
                            <option value="baixa">Baixa</option>
                        </select>
                    </div>

                    <!-- Data de vencimento -->
                    <div class="lg:col-span-2">
                        <label
                            for="due_date_filter"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1"
                            >Vencimento</label
                        >
                        <select
                            v-model="filters.due_date_filter"
                            id="due_date_filter"
                            class="w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="">Todas</option>
                            <option value="overdue">Em atraso</option>
                            <option value="today">Hoje</option>
                            <option value="this_week">Esta semana</option>
                        </select>
                    </div>

                    <!-- Ordenação -->
                    <div class="lg:col-span-2">
                        <label
                            for="sort"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1"
                            >Ordenar por</label
                        >
                        <select
                            v-model="filters.sort"
                            id="sort"
                            class="w-full rounded-md border-gray-300 dark:border-gray-500 dark:bg-white dark:text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="created_at_desc">
                                Mais recentes
                            </option>
                            <option value="created_at_asc">Mais antigas</option>
                            <option value="due_date_asc">
                                Vencimento (próximo)
                            </option>
                            <option value="due_date_desc">
                                Vencimento (distante)
                            </option>
                            <option value="priority_desc">
                                Prioridade (alta → baixa)
                            </option>
                            <option value="priority_asc">
                                Prioridade (baixa → alta)
                            </option>
                            <option value="title_asc">Título (A → Z)</option>
                            <option value="title_desc">Título (Z → A)</option>
                        </select>
                    </div>

                    <!-- Botões -->
                    <div class="lg:col-span-2 flex items-end space-x-2">
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center px-3 py-2 bg-gray-600 text-white text-sm rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 flex-1"
                        >
                            Filtrar
                        </button>
                        <button
                            @click="clearFilters"
                            type="button"
                            class="inline-flex items-center justify-center px-3 py-2 bg-gray-300 dark:bg-gray-500 text-gray-700 dark:text-white text-sm rounded-md hover:bg-gray-400 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 flex-1"
                        >
                            Limpar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Título da Vista Atual -->
            <div class="mb-6">
                <div class="flex items-center">
                    <h2
                        class="text-xl font-semibold text-gray-900 dark:text-white"
                    >
                        {{ currentViewTitle }}
                    </h2>
                    <span
                        class="ml-auto text-sm text-gray-500 dark:text-gray-400"
                    >
                        {{ tasks.total }}
                        {{ tasks.total === 1 ? "tarefa" : "tarefas" }}
                    </span>
                </div>
                <div class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                    {{ currentViewDescription }}
                </div>
            </div>

            <!-- Lista de tarefas -->
            <div
                v-if="tasks.data.length > 0"
                class="bg-white dark:bg-gray-700 shadow-sm rounded-lg border border-gray-200 dark:border-gray-600"
            >
                <div class="divide-y divide-gray-200 dark:divide-gray-600">
                    <div
                        v-for="task in tasks.data"
                        :key="task.id"
                        class="p-6 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150"
                    >
                        <div class="flex items-start justify-between">
                            <!-- Conteúdo da tarefa -->
                            <div class="flex items-start flex-1">
                                <div class="flex-1 min-w-0">
                                    <!-- Título -->
                                    <h3
                                        class="text-lg font-medium text-gray-900 dark:text-white"
                                    >
                                        {{ task.title }}
                                    </h3>

                                    <!-- Descrição -->
                                    <p
                                        v-if="task.description"
                                        class="mt-1 text-sm text-gray-600 dark:text-gray-300"
                                    >
                                        {{
                                            truncateText(task.description, 100)
                                        }}
                                    </p>

                                    <!-- Meta informações -->
                                    <div
                                        class="mt-2 flex flex-wrap items-center gap-3 text-xs"
                                    >
                                        <!-- Prioridade -->
                                        <span
                                            :class="
                                                getPriorityClass(task.priority)
                                            "
                                            class="inline-flex items-center px-2 py-1 rounded-full"
                                        >
                                            {{
                                                getPriorityLabel(task.priority)
                                            }}
                                        </span>

                                        <!-- Data de vencimento -->
                                        <span
                                            v-if="task.due_date"
                                            class="inline-flex items-center text-gray-500"
                                        >
                                            <svg
                                                class="w-4 h-4 mr-1"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                />
                                            </svg>
                                            {{ formatDate(task.due_date) }}
                                            <span
                                                v-if="isOverdue(task)"
                                                class="ml-1 text-red-600 dark:text-red-400 font-medium"
                                            >
                                                (Em atraso)
                                            </span>
                                        </span>

                                        <!-- Data de criação -->
                                        <span
                                            class="text-gray-400 dark:text-gray-500"
                                        >
                                            Criada em
                                            {{
                                                formatDateTime(task.created_at)
                                            }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Ações -->
                            <div class="flex items-center space-x-2 ml-4">
                                <!-- Botão para completar/descompletar -->
                                <button
                                    @click="toggleComplete(task)"
                                    :class="
                                        task.is_completed
                                            ? 'text-green-500 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300'
                                            : 'text-gray-400 hover:text-green-600 dark:text-gray-500 dark:hover:text-green-400'
                                    "
                                    :title="
                                        task.is_completed
                                            ? 'Marcar como pendente'
                                            : 'Marcar como concluída'
                                    "
                                >
                                    <svg
                                        v-if="task.is_completed"
                                        class="w-5 h-5"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    <svg
                                        v-else
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>
                                </button>

                                <Link
                                    :href="`/tasks/${task.id}`"
                                    class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300"
                                    title="Ver detalhes"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                        />
                                    </svg>
                                </Link>

                                <Link
                                    :href="`/tasks/${task.id}/edit`"
                                    class="text-indigo-400 hover:text-indigo-600 dark:text-indigo-300 dark:hover:text-indigo-200"
                                    title="Editar"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                        />
                                    </svg>
                                </Link>

                                <button
                                    @click="deleteTask(task)"
                                    class="text-red-400 hover:text-red-600 dark:text-red-300 dark:hover:text-red-200"
                                    title="Eliminar"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Paginação -->
            <div v-if="tasks.data.length > 0" class="mt-6">
                <Pagination :links="tasks.links" />
            </div>

            <!-- Estado vazio -->
            <div
                v-else
                class="bg-white dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 p-12 text-center"
            >
                <svg
                    class="w-12 h-12 text-gray-400 dark:text-gray-500 mx-auto mb-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                    />
                </svg>
                <h3
                    class="text-lg font-medium text-gray-900 dark:text-white mb-2"
                >
                    Nenhuma tarefa encontrada
                </h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    {{ emptyStateMessage }}
                </p>
                <Link
                    href="/tasks/create"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
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
                    Criar Primeira Tarefa
                </Link>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <ConfirmationModal
            :show="showDeleteModal"
            type="danger"
            :title="deleteModalData.title"
            :message="deleteModalData.message"
            confirmText="Sim, Eliminar"
            cancelText="Cancelar"
            :processing="deleteModalData.processing"
            processingText="A eliminar..."
            @confirm="confirmDelete"
            @cancel="cancelDelete"
            @close="cancelDelete"
        />
    </Layout>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import Pagination from "@/Components/Pagination.vue";

// Props
const props = defineProps({
    tasks: Object,
    filters: Object,
});

// State reativo para filtros
const filters = ref({
    search: props.filters.search || "",
    status: props.filters.status || "",
    priority: props.filters.priority || "",
    due_date_filter: props.filters.due_date_filter || "",
    sort: props.filters.sort || "created_at_desc",
});

// Modal state
const showDeleteModal = ref(false);
const deleteModalData = ref({
    task: null,
    title: "",
    message: "",
    processing: false,
});

// Computed properties
const currentViewTitle = computed(() => {
    if (filters.value.status === "completed") return "✅ Tarefas Concluídas";
    if (filters.value.status === "pending") return "⏳ Tarefas Pendentes";
    if (filters.value.due_date_filter === "overdue")
        return "⚠️ Tarefas em Atraso";
    if (filters.value.status === "all") return "📋 Todas as Tarefas";
    return "⚡ Tarefas Ativas";
});

const currentViewDescription = computed(() => {
    if (filters.value.status === "completed")
        return "Tarefas que já foram marcadas como concluídas";
    if (filters.value.status === "pending")
        return "Tarefas não concluídas que ainda não estão em atraso";
    if (filters.value.due_date_filter === "overdue")
        return "Tarefas que passaram da data de vencimento e ainda não foram concluídas";
    if (filters.value.status === "all")
        return "Todas as suas tarefas, incluindo concluídas e ativas";
    return "Tarefas que precisam da sua atenção (pendentes e em atraso)";
});

const emptyStateMessage = computed(() => {
    const hasFilters =
        filters.value.search ||
        filters.value.status ||
        filters.value.priority ||
        filters.value.due_date_filter;

    if (hasFilters) {
        return "Não existem tarefas que correspondam aos filtros selecionados.";
    } else if (!filters.value.status) {
        return 'Não tem tarefas ativas no momento. Todas as suas tarefas estão concluídas!\nPara ver tarefas concluídas, use o filtro "Concluídas" acima.';
    } else {
        return "Comece por criar a sua primeira tarefa para organizar as suas atividades.";
    }
});

// Methods
const applyFilters = () => {
    router.get("/tasks", filters.value, {
        preserveState: true,
        replace: true,
    });
};

const clearFilters = () => {
    filters.value = {
        search: "",
        status: "",
        priority: "",
        due_date_filter: "",
        sort: "created_at_desc",
    };
    router.get("/tasks", {}, { replace: true });
};

const toggleComplete = (task) => {
    router.patch(
        `/tasks/${task.id}/toggle-complete`,
        {},
        {
            preserveScroll: true,
            onSuccess: () => {
                // Task state will be updated by Inertia automatically
            },
        }
    );
};

const deleteTask = (task) => {
    deleteModalData.value = {
        task: task,
        title: "Eliminar Tarefa",
        message: `Tem certeza que deseja eliminar a tarefa "${task.title}"? Esta ação irá mover a tarefa para a lixeira.`,
        processing: false,
    };
    showDeleteModal.value = true;
};

const confirmDelete = () => {
    deleteModalData.value.processing = true;

    router.delete(`/tasks/${deleteModalData.value.task.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            showDeleteModal.value = false;
            deleteModalData.value.processing = false;
        },
        onError: () => {
            deleteModalData.value.processing = false;
        },
    });
};

const cancelDelete = () => {
    showDeleteModal.value = false;
    deleteModalData.value = {
        task: null,
        title: "",
        message: "",
        processing: false,
    };
};

// Utility functions
const truncateText = (text, length) => {
    if (text.length <= length) return text;
    return text.substring(0, length) + "...";
};

const getPriorityClass = (priority) => {
    switch (priority) {
        case "alta":
            return "bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300";
        case "media":
            return "bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300";
        case "baixa":
            return "bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300";
        default:
            return "bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300";
    }
};

const getPriorityLabel = (priority) => {
    switch (priority) {
        case "alta":
            return "Alta";
        case "media":
            return "Média";
        case "baixa":
            return "Baixa";
        default:
            return "Sem prioridade";
    }
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString("pt-PT");
};

const formatDateTime = (dateString) => {
    const date = new Date(dateString);
    return (
        date.toLocaleDateString("pt-PT") +
        " " +
        date.toLocaleTimeString("pt-PT", { hour: "2-digit", minute: "2-digit" })
    );
};

const isOverdue = (task) => {
    if (!task.due_date || task.is_completed) return false;
    const today = new Date();
    const dueDate = new Date(task.due_date);
    return dueDate < today;
};

// Watch for filter changes and apply automatically (debounced)
let timeout;
watch(
    filters,
    () => {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            applyFilters();
        }, 500);
    },
    { deep: true }
);
</script>
