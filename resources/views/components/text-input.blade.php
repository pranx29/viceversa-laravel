@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-foreground bg-primary text-white outline-none placeholder-foreground rounded-md focus:ring-0 focus:border-white']) }}>
