<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-light px-4 fw-bold shadow-sm border border-secondary border-opacity-25']) }}>
    {{ $slot }}
</button>
