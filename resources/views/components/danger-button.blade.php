<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-danger px-4 fw-bold shadow-sm']) }}>
    {{ $slot }}
</button>
