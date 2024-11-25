@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'flex items-center gap-2 rounded-lg bg-button px-4 py-2 text-sm font-medium'
        : 'flex items-center gap-2 rounded-lg text-foreground px-4 py-2 text-sm font-medium hover:bg-button hover:text-black';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>