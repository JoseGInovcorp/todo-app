<template>
    <Layout>
        <div class="max-w-7xl mx-auto py-8">
            <!-- Header -->
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8"
            >
                <div>
                    <h1
                        class="text-3xl font-bold text-gray-900 dark:text-white"
                    >
                        🗑️ Lixo
                    </h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                        Tarefas eliminadas (podem ser restauradas ou eliminadas
                        permanentemente)
                    </p>
                </div>
                <Link
                    href="/tasks"
                    class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
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
                            d="M15 19l-7-7 7-7"
                        ></path>
                    </svg>
                    Voltar às Tarefas
                </Link>
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

            <!-- Lista de tarefas eliminadas -->
            <div v-if="tasks.data.length > 0">
                <div
                    class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700"
                >
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        <div
                            v-for="task in tasks.data"
                            :key="task.id"
                            class="p-6 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500"
                        >
                            <div class="flex items-start justify-between">
                                <!-- Conteúdo da tarefa -->
                                <div class="flex items-start flex-1">
                                    <div class="flex-1 min-w-0">
                                        <!-- Título -->
                                        <h3
                                            class="text-lg font-medium text-red-900 dark:text-red-100 line-through"
                                        >
                                            {{ task.title }}
                                        </h3>

                                        <!-- Descrição -->
                                        <p
                                            v-if="task.description"
                                            class="mt-1 text-sm text-red-700 dark:text-red-200 line-through"
                                        >
                                            {{
                                                task.description.length > 100
                                                    ? task.description.substring(
                                                          0,
                                                          100
                                                      ) + "..."
                                                    : task.description
                                            }}
                                        </p>

                                        <!-- Meta informações -->
                                        <div
                                            class="mt-2 flex flex-wrap items-center gap-3 text-xs"
                                        >
                                            <!-- Prioridade -->
                                            <span
                                                :class="[
                                                    'inline-flex items-center px-2 py-1 rounded-full opacity-60',
                                                    getPriorityColor(
                                                        task.priority
                                                    ),
                                                ]"
                                            >
                                                {{
                                                    getPriorityLabel(
                                                        task.priority
                                                    )
                                                }}
                                            </span>

                                            <!-- Data de eliminação -->
                                            <span
                                                class="text-red-600 dark:text-red-400 font-medium"
                                            >
                                                <svg
                                                    class="w-4 h-4 mr-1 inline"
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
                                                Eliminada em
                                                {{
                                                    formatDeletedAt(
                                                        task.deleted_at
                                                    )
                                                }}
                                            </span>

                                            <!-- Data de criação -->
                                            <span
                                                class="text-gray-500 dark:text-gray-400"
                                            >
                                                Criada em
                                                {{
                                                    formatCreatedAt(
                                                        task.created_at
                                                    )
                                                }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ações -->
                                <div class="flex items-center space-x-2 ml-4">
                                    <!-- Restaurar -->
                                    <button
                                        @click="restoreTask(task.id)"
                                        :disabled="restoreForm.processing"
                                        class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300 disabled:opacity-50"
                                        title="Restaurar tarefa"
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
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                                            />
                                        </svg>
                                    </button>

                                    <!-- Eliminar permanentemente -->
                                    <button
                                        @click="forceDeleteTask(task.id)"
                                        :disabled="deleteForm.processing"
                                        class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-200 disabled:opacity-50"
                                        title="Eliminar permanentemente"
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
                                                d="M6 18L18 6M6 6l12 12"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paginação -->
                <div class="mt-6">
                    <Pagination :links="tasks.links" />
                </div>
            </div>

            <!-- Estado vazio -->
            <div
                v-else
                class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-12 text-center"
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
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                    />
                </svg>
                <h3
                    class="text-lg font-medium text-gray-900 dark:text-white mb-2"
                >
                    Lixo vazio
                </h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    Não tem tarefas eliminadas no momento.
                </p>
                <Link
                    href="/tasks"
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
                            d="M15 19l-7-7 7-7"
                        ></path>
                    </svg>
                    Voltar às Tarefas
                </Link>
            </div>

            <!-- Aviso sobre eliminação permanente -->
            <div
                v-if="tasks.data.length > 0"
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
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3
                            class="text-sm font-medium text-yellow-800 dark:text-yellow-200"
                        >
                            Informação Importante
                        </h3>
                        <div
                            class="mt-2 text-sm text-yellow-700 dark:text-yellow-300"
                        >
                            <p>
                                • <strong>Restaurar:</strong> A tarefa voltará à
                                lista normal e poderá ser editada normalmente
                            </p>
                            <p>
                                • <strong>Eliminar permanentemente:</strong> A
                                tarefa será apagada para sempre e não poderá ser
                                recuperada
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Restore Confirmation Modal -->
        <ConfirmationModal
            :show="showRestoreModal"
            type="info"
            :title="restoreModalData.title"
            :message="restoreModalData.message"
            confirmText="Sim, Restaurar"
            cancelText="Cancelar"
            :processing="restoreModalData.processing"
            processingText="A restaurar..."
            @confirm="confirmRestore"
            @cancel="cancelRestore"
            @close="cancelRestore"
        />

        <!-- Force Delete Confirmation Modal -->
        <ConfirmationModal
            :show="showForceDeleteModal"
            type="danger"
            :title="forceDeleteModalData.title"
            :processing="forceDeleteModalData.processing"
            processingText="A eliminar..."
            confirmText="Sim, Eliminar Permanentemente"
            cancelText="Cancelar"
            @confirm="confirmForceDelete"
            @cancel="cancelForceDelete"
            @close="cancelForceDelete"
        >
            <div class="text-left">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                    {{ forceDeleteModalData.message }}
                </p>
                <div
                    class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md p-3"
                >
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg
                                class="h-5 w-5 text-red-400"
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
                                ⚠️ ATENÇÃO: Esta ação é irreversível!
                            </h3>
                            <div
                                class="mt-2 text-sm text-red-700 dark:text-red-300"
                            >
                                <p>
                                    A tarefa será eliminada permanentemente e
                                    não poderá ser recuperada.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </ConfirmationModal>
    </Layout>
</template>

<script setup>
import { computed, ref } from "vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import Pagination from "@/Components/Pagination.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";

// Props
const props = defineProps({
    tasks: {
        type: Object,
        required: true,
    },
});

// Page data
const page = usePage();
const flashMessage = computed(() => page.props.flash);

// Forms
const restoreForm = useForm({});
const deleteForm = useForm({});

// Modal state
const showRestoreModal = ref(false);
const restoreModalData = ref({
    taskId: null,
    title: "",
    message: "",
    processing: false,
});

const showForceDeleteModal = ref(false);
const forceDeleteModalData = ref({
    taskId: null,
    title: "",
    message: "",
    processing: false,
});

// Methods
const getPriorityLabel = (priority) => {
    const labels = {
        alta: "Alta",
        media: "Média",
        baixa: "Baixa",
    };
    return labels[priority] || "Média";
};

const getPriorityColor = (priority) => {
    const colors = {
        alta: "bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300",
        media: "bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300",
        baixa: "bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300",
    };
    return colors[priority] || colors.media;
};

const formatDeletedAt = (deletedAt) => {
    const date = new Date(deletedAt);
    return date.toLocaleDateString("pt-PT", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    });
};

const formatCreatedAt = (createdAt) => {
    const date = new Date(createdAt);
    return date.toLocaleDateString("pt-PT", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    });
};

const restoreTask = (taskId) => {
    const task = props.tasks.data.find((t) => t.id === taskId);
    restoreModalData.value = {
        taskId: taskId,
        title: "Restaurar Tarefa",
        message: `Tem certeza que deseja restaurar a tarefa "${
            task?.title || "selecionada"
        }"? Ela voltará à lista normal de tarefas.`,
        processing: false,
    };
    showRestoreModal.value = true;
};

const confirmRestore = () => {
    restoreModalData.value.processing = true;

    restoreForm.patch(`/tasks/${restoreModalData.value.taskId}/restore`, {
        preserveScroll: true,
        onSuccess: () => {
            showRestoreModal.value = false;
            restoreModalData.value.processing = false;
        },
        onError: () => {
            restoreModalData.value.processing = false;
        },
    });
};

const cancelRestore = () => {
    showRestoreModal.value = false;
    restoreModalData.value = {
        taskId: null,
        title: "",
        message: "",
        processing: false,
    };
};

const forceDeleteTask = (taskId) => {
    const task = props.tasks.data.find((t) => t.id === taskId);
    forceDeleteModalData.value = {
        taskId: taskId,
        title: "Eliminar Permanentemente",
        message: `Tem certeza que deseja eliminar permanentemente a tarefa "${
            task?.title || "selecionada"
        }"?`,
        processing: false,
    };
    showForceDeleteModal.value = true;
};

const confirmForceDelete = () => {
    forceDeleteModalData.value.processing = true;

    deleteForm.delete(
        `/tasks/${forceDeleteModalData.value.taskId}/force-delete`,
        {
            preserveScroll: true,
            onSuccess: () => {
                showForceDeleteModal.value = false;
                forceDeleteModalData.value.processing = false;
            },
            onError: () => {
                forceDeleteModalData.value.processing = false;
            },
        }
    );
};

const cancelForceDelete = () => {
    showForceDeleteModal.value = false;
    forceDeleteModalData.value = {
        taskId: null,
        title: "",
        message: "",
        processing: false,
    };
};
</script>
