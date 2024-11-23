<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<section class="relative flex flex-wrap lg:h-screen lg:items-center">
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div
        class="w-full px-4 py-12 sm:px-6 sm:py-16 lg:w-1/2 lg:px-8 lg:py-24 sm:h-96 lg:h-full"
    >
        <form wire:submit="login" class="mx-auto max-w-md space-y-4">
            <div class="mx-auto max-w-lg">
                <h2
                    class="text-2xl font-bold text-primary-foreground sm:text-4xl"
                >
                    Login
                </h2>
            </div>
            <div>
                <label for="email" class="sr-only">Email</label>

                <div class="relative">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        wire:model="form.email"
                        id="email"
                        class="block mt-1 w-full"
                        type="email"
                        name="email"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <x-input-error
                        :messages="$errors->get('form.email')"
                        class="mt-2"
                    />
                </div>
            </div>

            <div>
                <label for="password" class="sr-only">Password</label>

                <div class="relative">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input
                        wire:model="form.password"
                        id="password"
                        class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                    />

                    <x-input-error
                        :messages="$errors->get('form.password')"
                        class="mt-2"
                    />
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="block mt-4">
                    <label for="remember" class="inline-flex items-center">
                        <input
                            wire:model="form.remember"
                            id="remember"
                            type="checkbox"
                            class="rounded bg-background border-border text-primary shadow-sm focus:ring-primary"
                            name="remember"
                        />
                        <span class="ms-2 text-sm text-foreground"
                            >{{ __('Remember me') }}</span
                        >
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                    <a
                        class="underline text-sm text-foreground hover:text-primary-foreground"
                        href="{{ route('password.request') }}"
                        wire:navigate
                    >
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                </div>
            </div>
            <x-primary-button class="w-full">
                {{ __('Log in') }}
            </x-primary-button>
        </form>
    </div>

    <div
        class="w-full px-4 py-12 sm:px-6 sm:py-16 lg:w-1/2 lg:px-8 lg:py-24 sm:h-96 lg:h-full"
    >
        <div class="mx-auto max-w-md space-y-4">
            <h2 class="text-2xl font-bold text-primary-foreground sm:text-4xl">
                Don't have an account?
            </h2>

            <a
                href="{{ route('register') }}"
                class="bg-button px-3 py-2 rounded-full transition-colors text-center duration-300 hover:bg-opacity-80 w-full inline-block"
            >
                Register
            </a>
        </div>
    </div>
</section>
