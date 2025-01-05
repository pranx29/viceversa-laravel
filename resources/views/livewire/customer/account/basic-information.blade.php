<section>
    <!-- Message Box -->
    @if (session()->has('message'))
        <x-alert>
            {{ session('message') }}
        </x-alert>
    @endif
    <div class="bg-primary shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4 text-primary-foreground">Basic Information</h2>
        <!-- Form -->
        <form wire:submit="save" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="firstName" :value="__('First Name')" />
                    <x-text-input wire:model.defer="firstName" id="firstName" type="text" class="w-full"
                        oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '')" />
                    <x-input-error :messages="$errors->get('firstName')" />
                </div>
                <div>
                    <x-input-label for="lastName" :value="__('Last Name')" />
                    <x-text-input wire:model.defer="lastName" id="lastName" type="text" class="w-full"
                        oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '')" />
                    <x-input-error :messages="$errors->get('lastName')" />
                </div>
            </div>
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model.defer="email" id="email" type="email" class="w-full"
                    oninput="this.value = this.value.replace(/[^a-zA-Z0-9@._-]/g, '')" />
                <x-input-error :messages="$errors->get('email')" />
            </div>
            <div class="flex items-center gap-4">
                <x-primary-button>
                    {{ __('Save Changes') }}
                </x-primary-button>

                <x-action-message class="me-3" on="basic-information-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    </div>
</section>
