<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn bg-blue-400 hover:bg-indigo-600 text-white whitespace-nowrap']) }}>
    {{ $slot }}
</button>
