<template>
    <nav class="flex items-center justify-between" aria-label="Pagination">
        <div class="hidden sm:block">
            <p class="text-sm text-gray-700 dark:text-gray-300">
                Mostrando
                <span class="font-medium">{{ from }}</span>
                a
                <span class="font-medium">{{ to }}</span>
                de
                <span class="font-medium">{{ total }}</span>
                resultados
            </p>
        </div>

        <div class="flex-1 flex justify-between sm:justify-end">
            <div class="flex items-center space-x-2">
                <!-- Previous Page Link -->
                <Link
                    v-if="previousPageUrl"
                    :href="previousPageUrl"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
                    preserve-scroll
                >
                    Anterior
                </Link>
                <span
                    v-else
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-300 bg-white border border-gray-300 rounded-md cursor-not-allowed dark:bg-gray-800 dark:border-gray-600 dark:text-gray-500"
                >
                    Anterior
                </span>

                <!-- Page Numbers -->
                <div class="hidden md:flex space-x-1">
                    <template v-for="(link, index) in pageLinks" :key="index">
                        <Link
                            v-if="link.url && !link.active"
                            :href="link.url"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
                            :class="{ 'rounded-md': isNumeric(link.label) }"
                            preserve-scroll
                            v-html="link.label"
                        />
                        <span
                            v-else-if="link.active"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-indigo-600 rounded-md cursor-default"
                            v-html="link.label"
                        />
                        <span
                            v-else
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300"
                            v-html="link.label"
                        />
                    </template>
                </div>

                <!-- Next Page Link -->
                <Link
                    v-if="nextPageUrl"
                    :href="nextPageUrl"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
                    preserve-scroll
                >
                    Próxima
                </Link>
                <span
                    v-else
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-300 bg-white border border-gray-300 rounded-md cursor-not-allowed dark:bg-gray-800 dark:border-gray-600 dark:text-gray-500"
                >
                    Próxima
                </span>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    links: Array,
});

// Computed properties para extrair informações da paginação Laravel
const pageLinks = computed(() => {
    if (!props.links || props.links.length < 3) return [];
    // Remove first (Previous) and last (Next) links, keep only page numbers
    return props.links.slice(1, -1);
});

const previousPageUrl = computed(() => {
    return props.links?.[0]?.url;
});

const nextPageUrl = computed(() => {
    return props.links?.[props.links.length - 1]?.url;
});

const from = computed(() => {
    // Extract from Laravel pagination info (you'll need to pass this from controller)
    // For now, we'll approximate based on current page and per_page
    const currentPageLink = props.links?.find((link) => link.active);
    if (!currentPageLink) return 0;

    const currentPage = parseInt(currentPageLink.label);
    const perPage = 10; // Default Laravel pagination
    return (currentPage - 1) * perPage + 1;
});

const to = computed(() => {
    const currentPageLink = props.links?.find((link) => link.active);
    if (!currentPageLink) return 0;

    const currentPage = parseInt(currentPageLink.label);
    const perPage = 10;
    const lastPageLink = props.links?.[props.links.length - 2]; // Second to last (last is "Next")
    const isLastPage =
        currentPage === parseInt(lastPageLink?.label || currentPage);

    if (isLastPage) {
        // For last page, calculate actual end based on total
        return total.value;
    }

    return currentPage * perPage;
});

const total = computed(() => {
    // This should ideally come from props, but we'll approximate
    // In a real implementation, you'd pass total from the controller
    const lastPageLink = props.links?.[props.links.length - 2];
    if (!lastPageLink) return 0;

    const lastPage = parseInt(lastPageLink.label);
    const perPage = 10;
    return lastPage * perPage; // Approximation
});

// Helper function
const isNumeric = (value) => {
    return !isNaN(parseFloat(value)) && isFinite(value);
};
</script>
