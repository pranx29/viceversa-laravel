@props(['disabled' => false])

<input type="number" @disabled($disabled) {{ $attributes->merge(['class' => 'border-foreground bg-primary text-white outline-none placeholder-primary rounded-md focus:ring-0 focus:border-white']) }}>