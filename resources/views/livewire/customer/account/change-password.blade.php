<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component {
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>
<section>
    <!-- Message Box -->
    @if (session()->has('message'))
        <x-alert>
            {{ session('message') }}
        </x-alert>
    @endif
    <div class="bg-primary shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4 text-primary-foreground">Change Password</h2>
        <!-- Form -->
        <form wire:submit="updatePassword" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                    <x-text-input wire:model="current_password" id="update_password_current_password"
                        name="current_password" type="password" class="w-full" autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('current_password')" />
                </div>
                <div>
                    <x-input-label for="update_password_password" :value="__('New Password')" />
                    <x-text-input wire:model="password" id="update_password_password" name="password" type="password"
                        class="w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" />
                </div>
            </div>
            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                <x-text-input wire:model="password_confirmation" id="update_password_password_confirmation"
                    name="password_confirmation" type="password" class="w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" />
            </div>
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Update Password') }}</x-primary-button>

                <x-action-message class="me-3" on="password-updated">
                    {{ __('Password Updated.') }}
                </x-action-message>
            </div>
        </form>
    </div>
</section>
