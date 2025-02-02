<?php

use App\Models\User;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

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

        if (auth()->user()->isAdmin()) {
            $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: true);
        } else {
            $this->redirectIntended(default: route('profile', absolute: false), navigate: true);
        }
    }
}
?>

<section class="flex items-center justify-center container mx-auto px-4 py-8">
    <!-- Left Section - Login Form -->
    <div class="w-full grid md:grid-cols-2 overflow-hidden gap-8">
        <form wire:submit="login" class="p-8 space-y-6 bg-primary rounded-lg">
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <div>
                <h2 class="text-4xl font-bold text-primary-foreground">
                    Login
                </h2>
                <p class="text-foreground">Enter your credentials to access your account</p>
            </div>
            <div>
                <label for="email" class="sr-only">Email</label>
                <div class="relative">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email"
                        required autofocus autocomplete="email" />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                </div>
            </div>

            <div>
                <label for="password" class="sr-only">Password</label>

                <div class="relative">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password"
                        name="password" required autocomplete="password" />

                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="block mt-4">
                    <label for="remember" class="inline-flex items-center">
                        <input wire:model="form.remember" id="remember" type="checkbox"
                            class="rounded bg-background border-border text-primary shadow-sm focus:ring-primary focus:border-primary checked:bg-background"
                            name="remember" />
                        <span class="ms-2 text-sm text-foreground">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-primary-foreground hover:text-foreground transition-all duration-300"
                            href="{{ route('password.request') }}" wire:navigate>
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </div>

            <div class="space-y-4">
                <x-primary-button class="w-full">
                    {{ __('Log in') }}
                </x-primary-button>
                <div class="text-center text-sm text-foreground md:hidden">
                    Don't have an account?
                    <a href="{{ route('register') }}"
                        class="font-semibold text-primary-foreground hover:text-foreground transition-all duration-300 ml-1">
                        Register
                    </a>
                </div>
            </div>
        </form>

        <!-- Right Section - Image and Welcome Message -->
        <div class="relative hidden md:block">
            <div class="mx-auto max-w-md space-y-4">
                <h2 class="text-2xl font-bold text-primary-foreground sm:text-4xl">
                    Don't have an account?
                </h2>

                <a href="{{ route('register') }}"
                    class="bg-button px-3 py-2 rounded-md transition-colors text-center duration-300 hover:bg-opacity-80 w-full inline-block">
                    Register
                </a>
            </div>
        </div>
    </div>
</section>
