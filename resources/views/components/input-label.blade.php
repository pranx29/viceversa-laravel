@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-foreground mb-1']) }}>
    {{ $value ?? $slot }}
</label>
