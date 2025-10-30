<div class="flex flex-col gap-6">
    <!-- Custom Header -->
    <div class="text-center mb-2">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white transition-colors duration-200">
            ✨ Criar Conta
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 transition-colors duration-200">
            Junte-se a nós e comece a organizar as suas tarefas
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Full name')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Password')"
            viewable
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirm password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirm password')"
            viewable
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                🎯 Criar Conta
            </flux:button>
        </div>
    </form>

    <div class="text-center pt-4 border-t border-gray-200 dark:border-gray-600 transition-colors duration-200">
        <p class="text-sm text-gray-600 dark:text-gray-300 transition-colors duration-200">
            Já tem uma conta?
        </p>
        <flux:link :href="route('login')" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 font-medium transition-colors duration-200">
            Iniciar sessão →
        </flux:link>
    </div>
</div>
