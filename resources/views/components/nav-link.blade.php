@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'transition-colors duration-300 px-5 py-2 rounded-md'
        : 'hover:bg-white text-foreground hover:text-black transition-colors duration-300 px-5 py-2 rounded-md';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
