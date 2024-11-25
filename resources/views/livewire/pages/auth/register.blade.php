<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>


<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <form wire:submit="register" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
        <div class="mx-auto max-w-lg">
            <h2 class="text-2xl font-bold text-primary-foreground sm:text-4xl">
                Create an account
            </h2>
            <h3 class="text-foreground font-thin text-xl mb-4">
                Personal Details
            </h3>
        </div>
        <div class="flex space-x-4">
            <div class="w-1/2">
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input
                    wire:model="first_name"
                    id="first_name"
                    class="block mt-1 w-full"
                    type="text"
                    name="first_name"
                    required
                    autofocus
                    autocomplete="given-name"
                />
                <x-input-error
                    :messages="$errors->get('first_name')"
                    class="mt-2"
                />
            </div>
            <div class="w-1/2">
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input
                    wire:model="last_name"
                    id="last_name"
                    class="block mt-1 w-full"
                    type="text"
                    name="last_name"
                    required
                    autocomplete="family-name"
                />
                <x-input-error
                    :messages="$errors->get('last_name')"
                    class="mt-2"
                />
            </div>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                wire:model="email"
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div>
            <x-input-label
                for="password_confirmation"
                :value="__('Confirm Password')"
            />

            <x-text-input
                wire:model="password_confirmation"
                id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />
        </div>

        <div class="flex items-center justify-between">
            <a
                class="underline text-sm text-foreground hover:text-primary-foreground whitespace-nowrap"
                href="{{ route('login') }}"
                wire:navigate
            >
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="w-1/3">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
