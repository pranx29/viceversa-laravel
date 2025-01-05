<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-button text-black px-6 py-2 rounded-md transition-colors duration-300 hover:bg-opacity-80']) }}>
    {{ $slot }}
</button>
