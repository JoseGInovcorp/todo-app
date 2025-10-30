<div class="flex flex-col gap-6">
    <!-- Custom Header -->
    <div class="text-center mb-2">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white transition-colors duration-200">
            🔐 Iniciar Sessão
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 transition-colors duration-200">
            Aceda à sua conta para gerir as suas tarefas
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Password')"
                viewable
            />

            @if (Route::has('password.request'))
                <flux:link class="absolute top-0 text-sm end-0" :href="route('password.request')">
                    {{ __('Forgot your password?') }}
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox wire:model="remember" :label="__('Remember me')" />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                🚀 Entrar
            </flux:button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="text-center pt-4 border-t border-gray-200 dark:border-gray-600 transition-colors duration-200">
            <p class="text-sm text-gray-600 dark:text-gray-300 transition-colors duration-200">
                Ainda não tem uma conta?
            </p>
            <flux:link :href="route('register')" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 font-medium transition-colors duration-200">
                Criar conta gratuita →
            </flux:link>
        </div>
    @endif
</div>
