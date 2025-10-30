<template>
    <Teleport to="body">
        <Transition name="modal-backdrop">
            <div
                v-if="show"
                class="fixed inset-0 z-50 overflow-y-auto"
                @click="handleBackdropClick"
            >
                <div
                    class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
                >
                    <Transition name="modal">
                        <div
                            v-if="show"
                            class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6"
                            @click.stop
                        >
                            <!-- Icon -->
                            <div
                                class="mx-auto flex h-12 w-12 items-center justify-center rounded-full"
                                :class="iconBgClass"
                            >
                                <component
                                    :is="iconComponent"
                                    class="h-6 w-6"
                                    :class="iconClass"
                                />
                            </div>

                            <!-- Content -->
                            <div class="mt-3 text-center sm:mt-5">
                                <h3
                                    class="text-base font-semibold leading-6 text-gray-900 dark:text-white"
                                    v-if="title"
                                >
                                    {{ title }}
                                </h3>
                                <div class="mt-2">
                                    <p
                                        class="text-sm text-gray-500 dark:text-gray-400"
                                        v-if="message"
                                    >
                                        {{ message }}
                                    </p>
                                    <div
                                        v-if="$slots.default"
                                        class="text-sm text-gray-500 dark:text-gray-400"
                                    >
                                        <slot />
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div
                                class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3"
                            >
                                <button
                                    type="button"
                                    :class="confirmButtonClass"
                                    @click="confirm"
                                    :disabled="processing"
                                    class="inline-flex w-full justify-center rounded-md px-3 py-2 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 sm:col-start-2 disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <svg
                                        v-if="processing"
                                        class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle
                                            class="opacity-25"
                                            cx="12"
                                            cy="12"
                                            r="10"
                                            stroke="currentColor"
                                            stroke-width="4"
                                        ></circle>
                                        <path
                                            class="opacity-75"
                                            fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                        ></path>
                                    </svg>
                                    {{
                                        processing
                                            ? processingText
                                            : confirmText
                                    }}
                                </button>
                                <button
                                    type="button"
                                    class="mt-3 inline-flex w-full justify-center items-center rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 sm:col-start-1 sm:mt-0"
                                    @click="cancel"
                                    :disabled="processing"
                                >
                                    {{ cancelText }}
                                </button>
                            </div>
                        </div>
                    </Transition>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup>
import { computed, nextTick, watch } from "vue";

// Icons
import {
    ExclamationTriangleIcon,
    TrashIcon,
    ArrowPathIcon,
    XMarkIcon,
} from "@heroicons/vue/24/outline";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    type: {
        type: String,
        default: "warning", // warning, danger, info
        validator: (value) => ["warning", "danger", "info"].includes(value),
    },
    title: {
        type: String,
        default: "",
    },
    message: {
        type: String,
        default: "",
    },
    confirmText: {
        type: String,
        default: "Confirmar",
    },
    cancelText: {
        type: String,
        default: "Cancelar",
    },
    processing: {
        type: Boolean,
        default: false,
    },
    processingText: {
        type: String,
        default: "A processar...",
    },
    closeOnBackdrop: {
        type: Boolean,
        default: true,
    },
});

const emit = defineEmits(["confirm", "cancel", "close"]);

// Computed properties for styling based on type
const iconComponent = computed(() => {
    switch (props.type) {
        case "danger":
            return TrashIcon;
        case "info":
            return ArrowPathIcon;
        default:
            return ExclamationTriangleIcon;
    }
});

const iconBgClass = computed(() => {
    switch (props.type) {
        case "danger":
            return "bg-red-100 dark:bg-red-900/30";
        case "info":
            return "bg-blue-100 dark:bg-blue-900/30";
        default:
            return "bg-yellow-100 dark:bg-yellow-900/30";
    }
});

const iconClass = computed(() => {
    switch (props.type) {
        case "danger":
            return "text-red-600 dark:text-red-400";
        case "info":
            return "text-blue-600 dark:text-blue-400";
        default:
            return "text-yellow-600 dark:text-yellow-400";
    }
});

const confirmButtonClass = computed(() => {
    switch (props.type) {
        case "danger":
            return "bg-red-600 text-white hover:bg-red-500 focus-visible:outline-red-600";
        case "info":
            return "bg-blue-600 text-white hover:bg-blue-500 focus-visible:outline-blue-600";
        default:
            return "bg-yellow-600 text-white hover:bg-yellow-500 focus-visible:outline-yellow-600";
    }
});

// Methods
const confirm = () => {
    if (!props.processing) {
        emit("confirm");
    }
};

const cancel = () => {
    if (!props.processing) {
        emit("cancel");
        emit("close");
    }
};

const handleBackdropClick = () => {
    if (props.closeOnBackdrop && !props.processing) {
        emit("cancel");
        emit("close");
    }
};

// Handle escape key
const handleEscape = (e) => {
    if (e.key === "Escape" && props.show && !props.processing) {
        emit("cancel");
        emit("close");
    }
};

// Watch for show changes to handle body scroll and escape key
watch(
    () => props.show,
    (newValue) => {
        if (newValue) {
            document.body.style.overflow = "hidden";
            document.addEventListener("keydown", handleEscape);
        } else {
            document.body.style.overflow = "";
            document.removeEventListener("keydown", handleEscape);
        }
    }
);
</script>

<style scoped>
/* Modal backdrop transition */
.modal-backdrop-enter-active,
.modal-backdrop-leave-active {
    transition: opacity 0.3s ease;
}

.modal-backdrop-enter-from,
.modal-backdrop-leave-to {
    opacity: 0;
}

.modal-backdrop-enter-to,
.modal-backdrop-leave-from {
    opacity: 1;
    background-color: rgba(0, 0, 0, 0.5);
}

/* Modal transition */
.modal-enter-active,
.modal-leave-active {
    transition: all 0.3s ease;
}

.modal-enter-from {
    opacity: 0;
    transform: scale(0.95) translateY(-10px);
}

.modal-leave-to {
    opacity: 0;
    transform: scale(0.95) translateY(10px);
}

.modal-enter-to,
.modal-leave-from {
    opacity: 1;
    transform: scale(1) translateY(0);
}
</style>
