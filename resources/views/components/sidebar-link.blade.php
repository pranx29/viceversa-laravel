@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'block gap-2 rounded-lg py-2'
        : 'block gap-2 rounded-lg text-foreground py-2 hover:text-black';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>