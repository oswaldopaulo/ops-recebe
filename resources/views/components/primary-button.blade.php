<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'btn btn-dark text-uppercase fw-semibold  text-white rounded transition ease-in-out'
]) }}>
    {{ $slot }}
</button>
