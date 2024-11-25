@props(['active'])

<div x-data="{ open: {{ $active ? 'true' : 'false' }} }">
    <button @click="open = !open" class="flex w-full items-center justify-between rounded-lg px-4 py-2 text-foreground hover:bg-button hover:text-black">
        <span class="text-sm font-medium flex items-center gap-2">
            {{ $title }}
        </span>
        <span :class="open ? '-rotate-180' : ''" class="shrink-0 transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </span>
    </button>

    <ul x-show="open" x-cloak class="mt-2 space-y-1 px-4">
        {{ $slot }}
    </ul>
</div>