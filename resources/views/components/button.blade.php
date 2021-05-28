<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-success']) }}>
    {{ $slot }}
</button>
