<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-button text-black px-3 py-2 rounded-full transition-colors duration-300 hover:bg-opacity-80']) }}>
    {{ $slot }}
</button>
