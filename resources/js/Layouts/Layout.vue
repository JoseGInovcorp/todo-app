<template>
    <div
        class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-200"
    >
        <!-- Sidebar for desktop -->
        <div
            v-if="user"
            class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col"
        >
            <div
                class="flex grow flex-col gap-y-5 overflow-y-auto bg-white dark:bg-gray-800 px-6 pb-4 shadow-xl"
            >
                <!-- Logo/Brand -->
                <div class="flex h-16 shrink-0 items-center">
                    <Link href="/" class="flex items-center space-x-2">
                        <span class="text-2xl">✅</span>
                        <span
                            class="text-xl font-bold text-gray-900 dark:text-white"
                            >{{ appName }}</span
                        >
                    </Link>
                </div>

                <!-- Navigation -->
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <!-- Main Navigation -->
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li>
                                    <Link
                                        href="/dashboard"
                                        :class="[
                                            'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                            currentRoute.startsWith(
                                                '/dashboard'
                                            )
                                                ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400'
                                                : 'text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                                        ]"
                                    >
                                        <svg
                                            class="h-6 w-6 shrink-0"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"
                                            />
                                        </svg>
                                        Dashboard
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        href="/tasks"
                                        :class="[
                                            'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                            currentRoute.startsWith('/tasks')
                                                ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400'
                                                : 'text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                                        ]"
                                    >
                                        <svg
                                            class="h-6 w-6 shrink-0"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3-9v9a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 18V6a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0122.5 6v3.75"
                                            />
                                        </svg>
                                        Tarefas
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        href="/tasks/create"
                                        :class="[
                                            'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                            currentRoute.startsWith(
                                                '/tasks/create'
                                            )
                                                ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400'
                                                : 'text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                                        ]"
                                    >
                                        <svg
                                            class="h-6 w-6 shrink-0"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 4.5v15m7.5-7.5h-15"
                                            />
                                        </svg>
                                        Nova Tarefa
                                    </Link>
                                </li>
                            </ul>
                        </li>

                        <!-- Task Filters -->
                        <li>
                            <div
                                class="text-xs font-semibold leading-6 text-gray-400 dark:text-gray-500"
                            >
                                Filtros
                            </div>
                            <ul role="list" class="-mx-2 mt-2 space-y-1">
                                <li>
                                    <Link
                                        href="/tasks?filter=pending"
                                        :class="[
                                            'group flex justify-between gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                            currentRoute.includes(
                                                'filter=pending'
                                            )
                                                ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400'
                                                : 'text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                                        ]"
                                    >
                                        <div class="flex items-center gap-x-3">
                                            <span
                                                class="h-2 w-2 rounded-full bg-yellow-500"
                                            ></span>
                                            Pendentes
                                        </div>
                                        <span
                                            v-if="taskCounters?.pending"
                                            class="ml-auto w-9 min-w-max whitespace-nowrap rounded-full bg-gray-50 dark:bg-gray-800 px-2.5 py-0.5 text-center text-xs font-medium text-gray-600 dark:text-gray-400 ring-1 ring-inset ring-gray-200 dark:ring-gray-700"
                                        >
                                            {{ taskCounters.pending }}
                                        </span>
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        href="/tasks?filter=completed"
                                        :class="[
                                            'group flex justify-between gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                            currentRoute.includes(
                                                'filter=completed'
                                            )
                                                ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400'
                                                : 'text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                                        ]"
                                    >
                                        <div class="flex items-center gap-x-3">
                                            <span
                                                class="h-2 w-2 rounded-full bg-green-500"
                                            ></span>
                                            Concluídas
                                        </div>
                                        <span
                                            v-if="taskCounters?.completed"
                                            class="ml-auto w-9 min-w-max whitespace-nowrap rounded-full bg-gray-50 dark:bg-gray-800 px-2.5 py-0.5 text-center text-xs font-medium text-gray-600 dark:text-gray-400 ring-1 ring-inset ring-gray-200 dark:ring-gray-700"
                                        >
                                            {{ taskCounters.completed }}
                                        </span>
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        href="/tasks?filter=overdue"
                                        :class="[
                                            'group flex justify-between gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                            currentRoute.includes(
                                                'filter=overdue'
                                            )
                                                ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400'
                                                : 'text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                                        ]"
                                    >
                                        <div class="flex items-center gap-x-3">
                                            <span
                                                class="h-2 w-2 rounded-full bg-red-500"
                                            ></span>
                                            Atrasadas
                                        </div>
                                        <span
                                            v-if="taskCounters?.overdue"
                                            class="ml-auto w-9 min-w-max whitespace-nowrap rounded-full bg-gray-50 dark:bg-gray-800 px-2.5 py-0.5 text-center text-xs font-medium text-gray-600 dark:text-gray-400 ring-1 ring-inset ring-gray-200 dark:ring-gray-700"
                                        >
                                            {{ taskCounters.overdue }}
                                        </span>
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        href="/tasks-trash"
                                        :class="[
                                            'group flex justify-between gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                            currentRoute.startsWith(
                                                '/tasks-trash'
                                            )
                                                ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400'
                                                : 'text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                                        ]"
                                    >
                                        <div class="flex items-center gap-x-3">
                                            <span
                                                class="h-2 w-2 rounded-full bg-gray-500"
                                            ></span>
                                            Lixeira
                                        </div>
                                        <span
                                            v-if="taskCounters?.trash"
                                            class="ml-auto w-9 min-w-max whitespace-nowrap rounded-full bg-gray-50 dark:bg-gray-800 px-2.5 py-0.5 text-center text-xs font-medium text-gray-600 dark:text-gray-400 ring-1 ring-inset ring-gray-200 dark:ring-gray-700"
                                        >
                                            {{ taskCounters.trash }}
                                        </span>
                                    </Link>
                                </li>
                            </ul>
                        </li>

                        <!-- Settings & User Profile (at bottom) -->
                        <li class="mt-auto">
                            <!-- Dark Mode Toggle -->
                            <button
                                @click="toggleTheme"
                                class="group flex w-full gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700"
                            >
                                <svg
                                    v-if="isDark"
                                    class="h-6 w-6 shrink-0"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                    />
                                </svg>
                                <svg
                                    v-else
                                    class="h-6 w-6 shrink-0"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"
                                    />
                                </svg>
                                {{ isDark ? "Modo Claro" : "Modo Escuro" }}
                            </button>

                            <!-- User Profile Dropdown -->
                            <div class="relative mt-2">
                                <button
                                    @click="userMenuOpen = !userMenuOpen"
                                    class="flex w-full items-center gap-x-4 px-2 py-3 text-sm font-semibold leading-6 text-gray-900 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-md"
                                >
                                    <div
                                        class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white text-sm font-medium"
                                    >
                                        {{ user.name.charAt(0).toUpperCase() }}
                                    </div>
                                    <span class="sr-only">Your profile</span>
                                    <div class="flex-1 text-left">
                                        <div
                                            class="text-sm font-medium text-gray-900 dark:text-white"
                                        >
                                            {{ user.name }}
                                        </div>
                                        <div
                                            class="text-xs text-gray-500 dark:text-gray-400"
                                        >
                                            {{ user.email }}
                                        </div>
                                    </div>
                                    <svg
                                        class="ml-auto h-5 w-5 text-gray-400"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>

                                <div
                                    v-show="userMenuOpen"
                                    @click.away="userMenuOpen = false"
                                    class="absolute bottom-full left-0 mb-2 w-full bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-10 ring-1 ring-black ring-opacity-5"
                                >
                                    <Link
                                        href="/settings/profile"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                                    >
                                        Configurações
                                    </Link>
                                    <form
                                        method="POST"
                                        action="/logout"
                                        style="display: inline"
                                    >
                                        <input
                                            type="hidden"
                                            name="_token"
                                            :value="
                                                $page.props.csrf_token ||
                                                document.querySelector(
                                                    'meta[name=csrf-token]'
                                                )?.content
                                            "
                                        />
                                        <button
                                            type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 border-none bg-transparent cursor-pointer"
                                        >
                                            Terminar Sessão
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Mobile sidebar -->
        <div v-if="user" class="lg:hidden">
            <!-- Off-canvas menu for mobile -->
            <div v-show="mobileMenuOpen" class="relative z-50">
                <!-- Backdrop -->
                <div
                    class="fixed inset-0 bg-gray-900/80"
                    @click="mobileMenuOpen = false"
                ></div>

                <!-- Sidebar -->
                <div class="fixed inset-0 flex">
                    <div class="relative mr-16 flex w-full max-w-xs flex-1">
                        <div
                            class="flex grow flex-col gap-y-5 overflow-y-auto bg-white dark:bg-gray-800 px-6 pb-4"
                        >
                            <!-- Mobile Logo -->
                            <div class="flex h-16 shrink-0 items-center">
                                <Link
                                    href="/"
                                    class="flex items-center space-x-2"
                                >
                                    <span class="text-2xl">✅</span>
                                    <span
                                        class="text-xl font-bold text-gray-900 dark:text-white"
                                        >{{ appName }}</span
                                    >
                                </Link>
                            </div>

                            <!-- Mobile Navigation (same structure as desktop) -->
                            <nav class="flex flex-1 flex-col">
                                <ul
                                    role="list"
                                    class="flex flex-1 flex-col gap-y-7"
                                >
                                    <!-- Main Navigation -->
                                    <li>
                                        <ul role="list" class="-mx-2 space-y-1">
                                            <li>
                                                <Link
                                                    href="/dashboard"
                                                    @click="
                                                        mobileMenuOpen = false
                                                    "
                                                    :class="[
                                                        'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                                        currentRoute.startsWith(
                                                            '/dashboard'
                                                        )
                                                            ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400'
                                                            : 'text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                                                    ]"
                                                >
                                                    <svg
                                                        class="h-6 w-6 shrink-0"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"
                                                        />
                                                    </svg>
                                                    Dashboard
                                                </Link>
                                            </li>
                                            <li>
                                                <Link
                                                    href="/tasks"
                                                    @click="
                                                        mobileMenuOpen = false
                                                    "
                                                    :class="[
                                                        'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                                        currentRoute.startsWith(
                                                            '/tasks'
                                                        )
                                                            ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400'
                                                            : 'text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                                                    ]"
                                                >
                                                    <svg
                                                        class="h-6 w-6 shrink-0"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3-9v9a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 18V6a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0122.5 6v3.75"
                                                        />
                                                    </svg>
                                                    Tarefas
                                                </Link>
                                            </li>
                                            <li>
                                                <Link
                                                    href="/tasks/create"
                                                    @click="
                                                        mobileMenuOpen = false
                                                    "
                                                    :class="[
                                                        'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                                        currentRoute.startsWith(
                                                            '/tasks/create'
                                                        )
                                                            ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400'
                                                            : 'text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                                                    ]"
                                                >
                                                    <svg
                                                        class="h-6 w-6 shrink-0"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M12 4.5v15m7.5-7.5h-15"
                                                        />
                                                    </svg>
                                                    Nova Tarefa
                                                </Link>
                                            </li>
                                        </ul>
                                    </li>

                                    <!-- Mobile Task Filters -->
                                    <li>
                                        <div
                                            class="text-xs font-semibold leading-6 text-gray-400 dark:text-gray-500"
                                        >
                                            Filtros
                                        </div>
                                        <ul
                                            role="list"
                                            class="-mx-2 mt-2 space-y-1"
                                        >
                                            <li>
                                                <Link
                                                    href="/tasks?filter=pending"
                                                    @click="
                                                        mobileMenuOpen = false
                                                    "
                                                    :class="[
                                                        'group flex justify-between gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                                        currentRoute.includes(
                                                            'filter=pending'
                                                        )
                                                            ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400'
                                                            : 'text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                                                    ]"
                                                >
                                                    <div
                                                        class="flex items-center gap-x-3"
                                                    >
                                                        <span
                                                            class="h-2 w-2 rounded-full bg-yellow-500"
                                                        ></span>
                                                        Pendentes
                                                    </div>
                                                    <span
                                                        v-if="
                                                            taskCounters?.pending
                                                        "
                                                        class="ml-auto w-9 min-w-max whitespace-nowrap rounded-full bg-gray-50 dark:bg-gray-800 px-2.5 py-0.5 text-center text-xs font-medium text-gray-600 dark:text-gray-400 ring-1 ring-inset ring-gray-200 dark:ring-gray-700"
                                                    >
                                                        {{
                                                            taskCounters.pending
                                                        }}
                                                    </span>
                                                </Link>
                                            </li>
                                            <li>
                                                <Link
                                                    href="/tasks?filter=completed"
                                                    @click="
                                                        mobileMenuOpen = false
                                                    "
                                                    :class="[
                                                        'group flex justify-between gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                                        currentRoute.includes(
                                                            'filter=completed'
                                                        )
                                                            ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400'
                                                            : 'text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                                                    ]"
                                                >
                                                    <div
                                                        class="flex items-center gap-x-3"
                                                    >
                                                        <span
                                                            class="h-2 w-2 rounded-full bg-green-500"
                                                        ></span>
                                                        Concluídas
                                                    </div>
                                                    <span
                                                        v-if="
                                                            taskCounters?.completed
                                                        "
                                                        class="ml-auto w-9 min-w-max whitespace-nowrap rounded-full bg-gray-50 dark:bg-gray-800 px-2.5 py-0.5 text-center text-xs font-medium text-gray-600 dark:text-gray-400 ring-1 ring-inset ring-gray-200 dark:ring-gray-700"
                                                    >
                                                        {{
                                                            taskCounters.completed
                                                        }}
                                                    </span>
                                                </Link>
                                            </li>
                                            <li>
                                                <Link
                                                    href="/tasks?filter=overdue"
                                                    @click="
                                                        mobileMenuOpen = false
                                                    "
                                                    :class="[
                                                        'group flex justify-between gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                                        currentRoute.includes(
                                                            'filter=overdue'
                                                        )
                                                            ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400'
                                                            : 'text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                                                    ]"
                                                >
                                                    <div
                                                        class="flex items-center gap-x-3"
                                                    >
                                                        <span
                                                            class="h-2 w-2 rounded-full bg-red-500"
                                                        ></span>
                                                        Atrasadas
                                                    </div>
                                                    <span
                                                        v-if="
                                                            taskCounters?.overdue
                                                        "
                                                        class="ml-auto w-9 min-w-max whitespace-nowrap rounded-full bg-gray-50 dark:bg-gray-800 px-2.5 py-0.5 text-center text-xs font-medium text-gray-600 dark:text-gray-400 ring-1 ring-inset ring-gray-200 dark:ring-gray-700"
                                                    >
                                                        {{
                                                            taskCounters.overdue
                                                        }}
                                                    </span>
                                                </Link>
                                            </li>
                                            <li>
                                                <Link
                                                    href="/tasks-trash"
                                                    @click="
                                                        mobileMenuOpen = false
                                                    "
                                                    :class="[
                                                        'group flex justify-between gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                                        currentRoute.startsWith(
                                                            '/tasks-trash'
                                                        )
                                                            ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400'
                                                            : 'text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                                                    ]"
                                                >
                                                    <div
                                                        class="flex items-center gap-x-3"
                                                    >
                                                        <span
                                                            class="h-2 w-2 rounded-full bg-gray-500"
                                                        ></span>
                                                        Lixeira
                                                    </div>
                                                    <span
                                                        v-if="
                                                            taskCounters?.trash
                                                        "
                                                        class="ml-auto w-9 min-w-max whitespace-nowrap rounded-full bg-gray-50 dark:bg-gray-800 px-2.5 py-0.5 text-center text-xs font-medium text-gray-600 dark:text-gray-400 ring-1 ring-inset ring-gray-200 dark:ring-gray-700"
                                                    >
                                                        {{ taskCounters.trash }}
                                                    </span>
                                                </Link>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <!-- Close button -->
                        <div
                            class="absolute left-full top-0 flex w-16 justify-center pt-5"
                        >
                            <button
                                @click="mobileMenuOpen = false"
                                class="-m-2.5 p-2.5"
                            >
                                <span class="sr-only">Close sidebar</span>
                                <svg
                                    class="h-6 w-6 text-white"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content area -->
        <div :class="user ? 'lg:pl-72' : ''">
            <!-- Top bar for mobile -->
            <div
                v-if="user"
                class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 shadow-sm lg:hidden"
            >
                <button
                    @click="mobileMenuOpen = true"
                    class="-m-2.5 p-2.5 text-gray-700 dark:text-gray-300 lg:hidden"
                >
                    <span class="sr-only">Open sidebar</span>
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                        />
                    </svg>
                </button>

                <!-- Mobile app name -->
                <div class="flex-1">
                    <h1
                        class="text-lg font-semibold text-gray-900 dark:text-white"
                    >
                        {{ appName }}
                    </h1>
                </div>

                <!-- Mobile user menu -->
                <div class="relative">
                    <button
                        @click="userMenuOpen = !userMenuOpen"
                        class="flex items-center gap-x-2 text-gray-700 dark:text-gray-300"
                    >
                        <div
                            class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white text-sm font-medium"
                        >
                            {{ user.name.charAt(0).toUpperCase() }}
                        </div>
                    </button>

                    <div
                        v-show="userMenuOpen"
                        @click.away="userMenuOpen = false"
                        class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-10 ring-1 ring-black ring-opacity-5"
                    >
                        <button
                            @click="toggleTheme"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                        >
                            {{ isDark ? "Modo Claro" : "Modo Escuro" }}
                        </button>
                        <Link
                            href="/settings/profile"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                        >
                            Configurações
                        </Link>
                        <form
                            method="POST"
                            action="/logout"
                            style="display: inline"
                        >
                            <input
                                type="hidden"
                                name="_token"
                                :value="
                                    $page.props.csrf_token ||
                                    document.querySelector(
                                        'meta[name=csrf-token]'
                                    )?.content
                                "
                            />
                            <button
                                type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 border-none bg-transparent cursor-pointer"
                            >
                                Terminar Sessão
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Guest header (when not logged in) -->
            <div
                v-else
                class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700"
            >
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <!-- Logo/Brand -->
                        <div class="flex items-center">
                            <Link href="/" class="flex items-center space-x-2">
                                <span class="text-2xl">✅</span>
                                <span
                                    class="text-xl font-bold text-gray-900 dark:text-white"
                                    >{{ appName }}</span
                                >
                            </Link>
                        </div>

                        <!-- Guest Links -->
                        <div class="flex items-center space-x-4">
                            <button
                                @click="toggleTheme"
                                class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium"
                            >
                                {{ isDark ? "☀️" : "🌙" }}
                            </button>
                            <Link
                                href="/login"
                                class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Entrar
                            </Link>
                            <Link
                                href="/register"
                                class="bg-indigo-600 text-white hover:bg-indigo-700 px-4 py-2 rounded-md text-sm font-medium"
                            >
                                Registar
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>

        <!-- Flash Messages -->
        <div
            v-if="flashMessage && (flashMessage.success || flashMessage.error)"
            class="fixed bottom-4 right-4 z-50"
        >
            <div
                :class="[
                    'px-4 py-3 rounded-md shadow-lg text-white',
                    flashMessage.success ? 'bg-green-500' : 'bg-red-500',
                ]"
            >
                {{ flashMessage.success || flashMessage.error }}
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

// State
const userMenuOpen = ref(false);
const mobileMenuOpen = ref(false);
const isDark = ref(false);

// Props do Inertia (globals)
const page = usePage();
const user = computed(() => page.props.auth?.user);
const appName = computed(() => page.props.appName || "To‑Do App");
const flashMessage = computed(() => page.props.flash);
const currentRoute = computed(() => page.url);
const taskCounters = computed(() => page.props.taskCounters);

// Dark mode functionality
const initTheme = () => {
    const savedTheme = localStorage.getItem("theme");
    const prefersDark = window.matchMedia(
        "(prefers-color-scheme: dark)"
    ).matches;
    const theme = savedTheme || (prefersDark ? "dark" : "light");

    isDark.value = theme === "dark";
    updateTheme();
};

const updateTheme = () => {
    if (isDark.value) {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }
};

const toggleTheme = () => {
    isDark.value = !isDark.value;
    localStorage.setItem("theme", isDark.value ? "dark" : "light");
    updateTheme();
};

// Close dropdowns when clicking outside
const handleClickOutside = (event) => {
    if (!event.target.closest(".relative")) {
        userMenuOpen.value = false;
    }
};

onMounted(() => {
    document.addEventListener("click", handleClickOutside);
    initTheme();
});

onUnmounted(() => {
    document.removeEventListener("click", handleClickOutside);
});
</script>
