<div class="flex flex-col gap-6">
    <!-- Custom Header -->
    <div class="text-center mb-2">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white transition-colors duration-200">
            🔑 Recuperar Password
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 transition-colors duration-200">
            Introduza o seu email para receber um link de recuperação
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email Address')"
            type="email"
            required
            autofocus
            placeholder="email@example.com"
        />

        <flux:button variant="primary" type="submit" class="w-full">📧 Enviar Link de Recuperação</flux:button>
    </form>

    <div class="text-center pt-4 border-t border-gray-200 dark:border-gray-600 transition-colors duration-200">
        <p class="text-sm text-gray-600 dark:text-gray-300 transition-colors duration-200">
            Lembrou-se da password?
        </p>
        <flux:link :href="route('login')" wire:navigate class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 font-medium transition-colors duration-200">
            Voltar ao login →
        </flux:link>
    </div>
</div>
