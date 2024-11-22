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

<div class="flex w-full justify-evenly p-20">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col w-1/3">
        <h2 class="text-primary-foreground font-semibold text-4xl mb-4">
            LOGIN</h2>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password"
                name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <div class="block mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox"
                        class="rounded bg-background border-border text-primary shadow-sm focus:ring-primary"
                        name="remember">
                    <span class="ms-2 text-sm text-foreground">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-foreground hover:text-primary-foreground"
                        href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </div>
        <x-primary-button class="mt-4">
            {{ __('Log in') }}
        </x-primary-button>
    </form>

    <!-- Ask for registration -->
    <div class="w-1/3 flex flex-col gap-y-4">
        <h2 class="text-white font-semibold text-4xl mb-4">
            NEED AN ACCOUNT?</h2>

        <a   href="{{ route('register') }}"
            class="bg-button px-3 py-2 rounded-full transition-colors text-center duration-300 hover:bg-opacity-80 w-full">
            REGISTER
        </a>

    </div>

</div>