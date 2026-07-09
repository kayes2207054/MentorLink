<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary btn-lg w-100 fw-bold shadow-sm']) }}>
    {{ $slot }}
</button>
