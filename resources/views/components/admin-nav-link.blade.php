@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'flex items-center px-6 py-2 mt-4 text-gray-100 bg-opacity-25 transition duration-150 ease-in-out bg-gray-700'
                : 'flex items-center px-6 py-2 mt-4 text-gray-500 bg-opacity-25 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 transition duration-150 ease-in-out'
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}

    @if ($active)
        <span class="flex justify-end ml-auto">
            <i class="fas fa-chevron-right"></i>
        </span>
    @endif
</a>
