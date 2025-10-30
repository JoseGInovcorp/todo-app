<template>
    <Layout>
        <div class="max-w-4xl mx-auto py-8">
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
                        >{{ task.title.substring(0, 50)
                        }}{{ task.title.length > 50 ? "..." : "" }}</span
                    >
                </div>
                <div
                    class="flex flex-col sm:flex-row sm:items-start sm:justify-between"
                >
                    <div class="flex-1">
                        <h1
                            :class="[
                                'text-3xl font-bold',
                                task.is_completed
                                    ? 'line-through text-gray-500 dark:text-gray-400'
                                    : 'text-gray-900 dark:text-white',
                            ]"
                        >
                            {{ task.title }}
                        </h1>
                        <p
                            v-if="task.description"
                            :class="[
                                'mt-2 text-lg text-gray-600 dark:text-gray-300',
                                task.is_completed ? 'line-through' : '',
                            ]"
                        >
                            {{ task.description }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Flash Messages -->
            <div
                v-if="flashMessage && flashMessage.success"
                class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-md p-4"
            >
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg
                            class="h-5 w-5 text-green-400 dark:text-green-300"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-800 dark:text-green-200">
                            {{ flashMessage.success }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Detalhes principais -->
                <div class="lg:col-span-2">
                    <div
                        class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 p-6"
                    >
                        <h2
                            class="text-lg font-medium text-gray-900 dark:text-white mb-4"
                        >
                            Detalhes da Tarefa
                        </h2>

                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Estado -->
                            <div>
                                <dt
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1"
                                >
                                    Estado
                                </dt>
                                <dd>
                                    <span
                                        v-if="task.is_completed"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300"
                                    >
                                        <svg
                                            class="w-3 h-3 mr-1"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        Concluída
                                    </span>
                                    <span
                                        v-else
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300"
                                    >
                                        <svg
                                            class="w-3 h-3 mr-1"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        Pendente
                                    </span>
                                </dd>
                            </div>

                            <!-- Prioridade -->
                            <div>
                                <dt
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1"
                                >
                                    Prioridade
                                </dt>
                                <dd>
                                    <span
                                        :class="[
                                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                                            priorityColor,
                                        ]"
                                    >
                                        {{ priorityEmoji }}
                                        {{ priorityLabel }}
                                    </span>
                                </dd>
                            </div>

                            <!-- Data de vencimento -->
                            <div>
                                <dt
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1"
                                >
                                    Data de Vencimento
                                </dt>
                                <dd
                                    class="text-sm text-gray-900 dark:text-white"
                                >
                                    <div
                                        v-if="task.due_date"
                                        class="flex items-center"
                                    >
                                        <svg
                                            class="w-4 h-4 mr-1 text-gray-400 dark:text-gray-500"
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
                                        {{ formattedDueDate }}
                                        <span
                                            v-if="isOverdue"
                                            class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300"
                                        >
                                            Em atraso
                                        </span>
                                    </div>
                                    <span
                                        v-else
                                        class="text-gray-400 dark:text-gray-500 italic"
                                        >Sem prazo definido</span
                                    >
                                </dd>
                            </div>

                            <!-- Data de criação -->
                            <div>
                                <dt
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1"
                                >
                                    Criada em
                                </dt>
                                <dd
                                    class="text-sm text-gray-900 dark:text-white"
                                >
                                    {{ formattedCreatedAt }}
                                </dd>
                            </div>

                            <!-- Última atualização -->
                            <div
                                v-if="task.updated_at !== task.created_at"
                                class="sm:col-span-2"
                            >
                                <dt
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1"
                                >
                                    Última atualização
                                </dt>
                                <dd
                                    class="text-sm text-gray-900 dark:text-white"
                                >
                                    {{ formattedUpdatedAt }}
                                    <span
                                        class="text-gray-400 dark:text-gray-500"
                                    >
                                        ({{ updatedFromNow }})
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Descrição completa -->
                    <div
                        v-if="task.description"
                        class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 p-6"
                    >
                        <h2
                            class="text-lg font-medium text-gray-900 dark:text-white mb-4"
                        >
                            Descrição Completa
                        </h2>
                        <div class="prose max-w-none">
                            <p
                                class="text-gray-700 dark:text-gray-300 whitespace-pre-line"
                            >
                                {{ task.description }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar com ações -->
                <div class="lg:col-span-1">
                    <div
                        class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 p-6"
                    >
                        <h2
                            class="text-lg font-medium text-gray-900 dark:text-white mb-4"
                        >
                            Ações Rápidas
                        </h2>

                        <div class="space-y-3">
                            <!-- Toggle de conclusão -->
                            <button
                                @click="toggleComplete"
                                :disabled="toggleForm.processing"
                                :class="[
                                    'w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150',
                                    task.is_completed
                                        ? 'bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-400'
                                        : 'bg-green-600 hover:bg-green-700 focus:ring-green-500',
                                    toggleForm.processing
                                        ? 'opacity-50 cursor-not-allowed'
                                        : '',
                                ]"
                            >
                                <svg
                                    v-if="task.is_completed"
                                    class="w-4 h-4 mr-2"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                                <svg
                                    v-else
                                    class="w-4 h-4 mr-2"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                {{
                                    task.is_completed
                                        ? "Marcar Pendente"
                                        : "Marcar Concluída"
                                }}
                            </button>

                            <!-- Editar -->
                            <Link
                                :href="`/tasks/${task.id}/edit`"
                                class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition ease-in-out duration-150"
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
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                    />
                                </svg>
                                Editar Tarefa
                            </Link>

                            <!-- Duplicar -->
                            <Link
                                :href="`/tasks/create?duplicate=${task.id}`"
                                class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 transition ease-in-out duration-150"
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
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                                    />
                                </svg>
                                Duplicar Tarefa
                            </Link>

                            <!-- Voltar à lista -->
                            <Link
                                href="/tasks"
                                class="w-full inline-flex justify-center items-center px-4 py-2 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-white uppercase tracking-widest shadow-sm hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
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
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                                Voltar à Lista
                            </Link>

                            <!-- Eliminar -->
                            <button
                                @click="deleteTask"
                                :disabled="deleteForm.processing"
                                :class="[
                                    'w-full inline-flex justify-center items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition ease-in-out duration-150',
                                    deleteForm.processing
                                        ? 'opacity-50 cursor-not-allowed'
                                        : '',
                                ]"
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
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                    />
                                </svg>
                                Eliminar Tarefa
                            </button>
                        </div>
                    </div>

                    <!-- Dicas -->
                    <div
                        v-if="!task.is_completed && isOverdue"
                        class="mt-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md p-4"
                    >
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg
                                    class="h-5 w-5 text-red-400 dark:text-red-300"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3
                                    class="text-sm font-medium text-red-800 dark:text-red-200"
                                >
                                    Tarefa em atraso!
                                </h3>
                                <div
                                    class="mt-2 text-sm text-red-700 dark:text-red-300"
                                >
                                    <p>
                                        Esta tarefa já passou do prazo de
                                        vencimento. Considere atualizá-la ou
                                        marcá-la como concluída.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        v-else-if="!task.is_completed && isDueToday"
                        class="mt-6 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-md p-4"
                    >
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg
                                    class="h-5 w-5 text-yellow-400 dark:text-yellow-300"
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
                                    class="text-sm font-medium text-yellow-800 dark:text-yellow-200"
                                >
                                    Vence hoje!
                                </h3>
                                <div
                                    class="mt-2 text-sm text-yellow-700 dark:text-yellow-300"
                                >
                                    <p>
                                        Esta tarefa vence hoje. Não se esqueça
                                        de a concluir.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <ConfirmationModal
            :show="showDeleteModal"
            type="danger"
            title="Eliminar Tarefa"
            :message="`Tem certeza que deseja eliminar a tarefa &quot;${task.title}&quot;? Esta ação irá mover a tarefa para a lixeira.`"
            confirmText="Sim, Eliminar"
            cancelText="Cancelar"
            :processing="deleteModalProcessing"
            processingText="A eliminar..."
            @confirm="confirmDelete"
            @cancel="cancelDelete"
            @close="cancelDelete"
        />
    </Layout>
</template>

<script setup>
import { computed, ref } from "vue";
import { Link, useForm, usePage, router } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";

// Props
const props = defineProps({
    task: {
        type: Object,
        required: true,
    },
});

// Page data
const page = usePage();
const flashMessage = computed(() => page.props.flash);

// Forms
const toggleForm = useForm({});
const deleteForm = useForm({});

// Modal state
const showDeleteModal = ref(false);
const deleteModalProcessing = ref(false);

// Task properties computeds
const priorityLabel = computed(() => {
    const labels = {
        alta: "Alta",
        media: "Média",
        baixa: "Baixa",
    };
    return labels[props.task.priority] || "Média";
});

const priorityEmoji = computed(() => {
    const emojis = {
        alta: "🔴",
        media: "🟡",
        baixa: "🟢",
    };
    return emojis[props.task.priority] || "🟡";
});

const priorityColor = computed(() => {
    const colors = {
        alta: "bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300",
        media: "bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300",
        baixa: "bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300",
    };
    return colors[props.task.priority] || colors.media;
});

// Date computeds
const formattedDueDate = computed(() => {
    if (!props.task.due_date) return null;
    const date = new Date(props.task.due_date);
    return date.toLocaleDateString("pt-PT", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
    });
});

const formattedCreatedAt = computed(() => {
    const date = new Date(props.task.created_at);
    return date.toLocaleDateString("pt-PT", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    });
});

const formattedUpdatedAt = computed(() => {
    const date = new Date(props.task.updated_at);
    return date.toLocaleDateString("pt-PT", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    });
});

const updatedFromNow = computed(() => {
    const date = new Date(props.task.updated_at);
    const now = new Date();
    const diffMs = now - date;
    const diffMins = Math.floor(diffMs / 60000);
    const diffHours = Math.floor(diffMins / 60);
    const diffDays = Math.floor(diffHours / 24);

    if (diffMins < 1) return "há poucos segundos";
    if (diffMins < 60) return `há ${diffMins} minuto${diffMins > 1 ? "s" : ""}`;
    if (diffHours < 24)
        return `há ${diffHours} hora${diffHours > 1 ? "s" : ""}`;
    return `há ${diffDays} dia${diffDays > 1 ? "s" : ""}`;
});

const isOverdue = computed(() => {
    if (!props.task.due_date || props.task.is_completed) return false;
    return new Date(props.task.due_date) < new Date().setHours(0, 0, 0, 0);
});

const isDueToday = computed(() => {
    if (!props.task.due_date) return false;
    const today = new Date().toDateString();
    const dueDate = new Date(props.task.due_date).toDateString();
    return today === dueDate;
});

// Methods
const toggleComplete = () => {
    toggleForm.patch(`/tasks/${props.task.id}/toggle-complete`, {
        preserveScroll: true,
        only: ["task", "flash"],
        onSuccess: () => {
            // State will be updated automatically by Inertia
        },
    });
};

const deleteTask = () => {
    showDeleteModal.value = true;
};

const confirmDelete = () => {
    deleteModalProcessing.value = true;

    deleteForm.delete(`/tasks/${props.task.id}`, {
        onSuccess: () => {
            router.visit("/tasks");
        },
        onError: () => {
            deleteModalProcessing.value = false;
        },
        onFinish: () => {
            showDeleteModal.value = false;
        },
    });
};

const cancelDelete = () => {
    showDeleteModal.value = false;
    deleteModalProcessing.value = false;
};
</script>
