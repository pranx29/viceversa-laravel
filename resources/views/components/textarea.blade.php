@props([
    'disabled' => false,
    'rows' => 3,
])

<textarea rows="{{ $rows }}" {{ $disabled ? 'disabled' : '' }} {{ $attributes->class(['border-foreground bg-primary text-white outline-none placeholder-primary rounded-md focus:ring-0 focus:border-white resize-none align-top w-full']) }}></textarea>
{{ $slot }}
</textarea>