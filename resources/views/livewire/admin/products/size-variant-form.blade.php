<div>
    <div class="bg-primary rounded-lg p-6 shadow-lg">
        <h2 class="text-2xl font-bold mb-2 text-primary-foreground">Stock</h2>
        <p class="text-foreground mb-4">Manage your product variants and inventory</p>

        <div class="max-h-56 overflow-y-auto">
            <table class="w-full">
                <thead>
                    <th class="text-left py-3 px-2 text-sm font-medium text-primary-foreground">Size</th>
                    <th class="text-left py-3 px-2 text-sm font-medium text-primary-foreground">Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($variants as $index => $variant)
                        <tr>
                            <td class="py-3 px-2">
                                <x-select-input wire:model="variants.{{ $index }}.size_id" required>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                                    @endforeach
                                </x-select-input>
                            </td>
                            <td class="py-3 px-2">
                                <x-text-input wire:model="variants.{{ $index }}.stock" type="number" min="0" required
                                    class="w-20" />
                            </td>
                            <td class="py-3 px-2">
                                <button wire:click.prevent="removeVariant({{ $index }})"
                                    class="text-foreground text-sm hover:text-foreground/80 transition duration-300 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M3 6h18"></path>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <button wire:click.prevent="addVariant"
            class="mt-4 px-4 py-2 text-sm flex items-center gap-2 text-foreground hover:text-primary-foreground transition-all duration-300 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="8" x2="12" y2="16" />
                <line x1="8" y1="12" x2="16" y2="12" />
            </svg>
            Add Size
        </button>
        @if (session()->has('error'))
            <div class="mt-4 text-red-500">{{ session('error') }}</div>
        @endif
    </div>
</div>