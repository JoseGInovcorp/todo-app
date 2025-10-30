<template>
    <Layout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    📊 Dashboard
                </h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                    Visão geral das suas tarefas e produtividade
                </p>
            </div>

            <!-- Métricas Principais -->
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8"
            >
                <!-- Total de Tarefas -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700"
                >
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-md flex items-center justify-center"
                                >
                                    <span class="text-xl">📋</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400"
                                >
                                    Total de Tarefas
                                </p>
                                <p
                                    class="text-2xl font-bold text-gray-900 dark:text-white"
                                >
                                    {{ totalTasks }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarefas Pendentes -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700"
                >
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900 rounded-md flex items-center justify-center"
                                >
                                    <span class="text-xl">⏳</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400"
                                >
                                    Pendentes
                                </p>
                                <p
                                    class="text-2xl font-bold text-gray-900 dark:text-white"
                                >
                                    {{ pendingTasks }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarefas Concluídas -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700"
                >
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-md flex items-center justify-center"
                                >
                                    <span class="text-xl">✅</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400"
                                >
                                    Concluídas
                                </p>
                                <p
                                    class="text-2xl font-bold text-gray-900 dark:text-white"
                                >
                                    {{ completedTasks }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarefas em Atraso -->
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700"
                >
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-8 h-8 bg-red-100 dark:bg-red-900 rounded-md flex items-center justify-center"
                                >
                                    <span class="text-xl">⚠️</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400"
                                >
                                    Em Atraso
                                </p>
                                <p
                                    class="text-2xl font-bold text-gray-900 dark:text-white"
                                >
                                    {{ overdueTasks }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estatísticas Detalhadas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Estatísticas por Prioridade -->
                <div
                    class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700"
                >
                    <div class="p-6">
                        <h3
                            class="text-lg font-medium text-gray-900 dark:text-white mb-4"
                        >
                            🎯 Tarefas por Prioridade
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-red-500">🔴</span>
                                    <span
                                        class="ml-2 text-sm text-gray-700 dark:text-gray-300"
                                        >Alta</span
                                    >
                                </div>
                                <span
                                    class="text-sm font-medium text-gray-900 dark:text-white"
                                    >{{ highPriorityTasks }}</span
                                >
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-yellow-500">🟡</span>
                                    <span
                                        class="ml-2 text-sm text-gray-700 dark:text-gray-300"
                                        >Média</span
                                    >
                                </div>
                                <span
                                    class="text-sm font-medium text-gray-900 dark:text-white"
                                    >{{ mediumPriorityTasks }}</span
                                >
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-green-500">🟢</span>
                                    <span
                                        class="ml-2 text-sm text-gray-700 dark:text-gray-300"
                                        >Baixa</span
                                    >
                                </div>
                                <span
                                    class="text-sm font-medium text-gray-900 dark:text-white"
                                    >{{ lowPriorityTasks }}</span
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estatísticas Período (Hoje / Esta Semana) -->
                <div
                    class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700"
                >
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3
                                class="text-lg font-medium text-gray-900 dark:text-white"
                            >
                                📅 {{ showToday ? "Hoje" : "Esta Semana" }}
                            </h3>
                            <button
                                @click="togglePeriod"
                                class="inline-flex items-center px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-xs font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors"
                            >
                                <span class="mr-1">🔄</span>
                                {{ showToday ? "Ver Semana" : "Ver Hoje" }}
                            </button>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-blue-500">➕</span>
                                    <span
                                        class="ml-2 text-sm text-gray-700 dark:text-gray-300"
                                        >Tarefas Criadas</span
                                    >
                                </div>
                                <span
                                    class="text-sm font-medium text-gray-900 dark:text-white"
                                    >{{
                                        showToday
                                            ? todayCreated
                                            : thisWeekCreated
                                    }}</span
                                >
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-green-500">✅</span>
                                    <span
                                        class="ml-2 text-sm text-gray-700 dark:text-gray-300"
                                        >Tarefas Concluídas</span
                                    >
                                </div>
                                <span
                                    class="text-sm font-medium text-gray-900 dark:text-white"
                                    >{{
                                        showToday
                                            ? todayCompleted
                                            : thisWeekCompleted
                                    }}</span
                                >
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-red-500">🗑️</span>
                                    <span
                                        class="ml-2 text-sm text-gray-700 dark:text-gray-300"
                                        >Tarefas Eliminadas</span
                                    >
                                </div>
                                <span
                                    class="text-sm font-medium text-gray-900 dark:text-white"
                                    >{{
                                        showToday
                                            ? todayDeleted
                                            : thisWeekDeleted
                                    }}</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Próximas Tarefas -->
            <div
                v-if="upcomingTasks.length > 0"
                class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 mb-8"
            >
                <div class="p-6">
                    <h3
                        class="text-lg font-medium text-gray-900 dark:text-white mb-4"
                    >
                        📅 Próximas Tarefas (7 dias)
                    </h3>
                    <div class="space-y-3">
                        <div
                            v-for="task in upcomingTasks"
                            :key="task.id"
                            class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-md"
                        >
                            <div class="flex items-center space-x-3">
                                <span class="text-lg">
                                    {{
                                        task.priority === "alta"
                                            ? "🔴"
                                            : task.priority === "media"
                                            ? "🟡"
                                            : "🟢"
                                    }}
                                </span>
                                <div>
                                    <p
                                        class="text-sm font-medium text-gray-900 dark:text-white"
                                    >
                                        {{ task.title }}
                                    </p>
                                    <p
                                        class="text-xs text-gray-500 dark:text-gray-400"
                                    >
                                        Vence em {{ formatDate(task.due_date) }}
                                    </p>
                                </div>
                            </div>
                            <a
                                :href="`/tasks/${task.id}`"
                                class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 text-sm font-medium"
                            >
                                Ver →
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ações Rápidas -->
            <div
                class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700"
            >
                <div class="p-6">
                    <h3
                        class="text-lg font-medium text-gray-900 dark:text-white mb-4"
                    >
                        ⚡ Ações Rápidas
                    </h3>
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4"
                    >
                        <a
                            href="/tasks/create"
                            class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors"
                        >
                            <span class="mr-2">✨</span>
                            Nova Tarefa
                        </a>
                        <a
                            href="/tasks"
                            class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors"
                        >
                            <span class="mr-2">📋</span>
                            Todas as Tarefas
                        </a>
                        <a
                            href="/tasks?status=pending"
                            class="inline-flex items-center justify-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-colors"
                        >
                            <span class="mr-2">⏳</span>
                            Tarefas Pendentes
                        </a>
                        <a
                            href="/tasks-trash"
                            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors"
                        >
                            <span class="mr-2">🗑️</span>
                            Lixo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from "@/Layouts/Layout.vue";
import { ref } from "vue";

// Props recebidas do Laravel via Inertia
const props = defineProps({
    // Dados do usuário
    user: Object,
    appName: String,

    // Métricas principais (4 cards)
    totalTasks: Number,
    pendingTasks: Number,
    completedTasks: Number,
    overdueTasks: Number,

    // Estatísticas por prioridade
    highPriorityTasks: Number,
    mediumPriorityTasks: Number,
    lowPriorityTasks: Number,

    // Estatísticas de hoje
    todayCreated: Number,
    todayCompleted: Number,
    todayDeleted: Number,

    // Estatísticas desta semana
    thisWeekCreated: Number,
    thisWeekCompleted: Number,
    thisWeekDeleted: Number,

    // Estatísticas da semana passada
    lastWeekCreated: Number,
    lastWeekCompleted: Number,

    // Próximas tarefas
    upcomingTasks: Array,
});

// Estado reativo para alternar entre hoje e esta semana
const showToday = ref(false);

// Função para alternar o período
const togglePeriod = () => {
    showToday.value = !showToday.value;
};

// Métodos auxiliares
const formatDate = (dateString) => {
    const date = new Date(dateString);
    const today = new Date();
    const diffTime = date.getTime() - today.getTime();
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    if (diffDays === 0) return "hoje";
    if (diffDays === 1) return "amanhã";
    if (diffDays === -1) return "ontem";
    if (diffDays > 0) return `${diffDays} dias`;
    return `${Math.abs(diffDays)} dias atrás`;
};

const getProgressPercentage = () => {
    if (props.totalTasks === 0) return 0;
    return Math.round((props.completedTasks / props.totalTasks) * 100);
};
</script>
