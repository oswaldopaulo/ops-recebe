<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'btn btn-danger text-uppercase fw-semibold text-white rounded'
]) }}>
    {{ $slot }}
</button>
