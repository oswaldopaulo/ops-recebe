<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'btn btn-light fw-semibold text-secondary text-uppercase rounded shadow-sm'
]) }}>
    {{ $slot }}
</button>
