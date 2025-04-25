<button {{ $attributes->merge(['class' => 'btn btn-' . ($attributes->get('class', 'primary'))]) }}>
    {{ $slot }}
</button>