<div class="space-y-8">
    <!-- Add/Edit Size Card -->
    <div class="rounded-lg p-6 bg-primary">
        <div>
            <h3 class="text-2xl font-bold mb-2 text-primary-foreground">{{ $editingId ? 'Edit Size' : 'Add New Size' }}
            </h3>
        </div>
        <div class="card-content">
            <div class="flex items-end space-x-4">
                <div class="flex-grow">
                    <x-input-label for="sizeName" :value="__('Size Name')" />
                    <x-text-input wire:model.defer="newSize.name" id="sizeName" type="text" class="w-full"
                        placeholder="Enter size name (e.g., XL)" oninput="this.value = this.value.toUpperCase()" />
                    <x-input-error :messages="$errors->get('newSize.name')" class="mt-2" />
                </div>
                <button wire:click="addSize"
                    class="rounded-lg bg-button px-4 py-2 text-sm font-medium hover:bg-opacity-80 transition-colors">
                    {{ $editingId ? 'Update' : 'Save' }}
                </button>
                @if ($editingId)
                    <button wire:click="cancelEdit"
                        class="rounded-lg bg-background text-foreground px-4 py-2 text-sm font-medium hover:bg-opacity-80 transition-colors">
                        Cancel
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Sizes List Card -->
    <div class="card">
        <div class="card-header">
            <h3 class="text-2xl font-bold mb-2 text-primary-foreground">Sizes List</h3>
        </div>
        <div class="card-content">
            <div
                class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-primary/50 shadow-md rounded-lg bg-clip-border">
                <table class="w-full text-left table-auto min-w-max">
                    <thead>
                        <tr class="border-b border-foreground bg-primary">
                            <th class="p-4 text-sm font-normal leading-none text-foreground">ID</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Name</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Status</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sizes as $size)
                            <tr class="cursor-pointer">
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">{{ $size['id'] }}
                                </td>
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">{{ $size['name'] }}
                                </td>
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                    <input type="checkbox" wire:model.live="sizes.{{ $loop->index }}.status"
                                        class="rounded bg-background border-border text-primary shadow-sm focus:ring-primary focus:border-primary checked:bg-background"
                                        {{ $size['status'] ? 'checked' : '' }} />
                                </td>
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3 space-x-4">
                                    <button wire:click="editSize('{{ $size['id'] }}')">
                                        <x-iconsax-lin-edit
                                            class="text-foreground hover:text-foreground/80 transition duration-300 ease-in-out size-5" />
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
