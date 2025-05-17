@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'form-control shadow-sm rounded border border-secondary']) }}>
