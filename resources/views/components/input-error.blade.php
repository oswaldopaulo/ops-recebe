@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'alert alert-danger']) }} role="alert">
        @foreach ((array) $messages as $message)
            <li>{{ __($message) }}</li>
        @endforeach
    </ul>
@endif
