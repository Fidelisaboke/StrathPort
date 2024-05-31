@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-grey-300 focus:border-fuchsia-600 focus:ring-fuchsia-600 rounded-md shadow-sm']) !!}>
