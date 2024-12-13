@props([
    'type' => 'default', // 'success', 'danger', 'warning', 'default'
    'text' => '',
])

@php
    $classes = match ($type) {
        'success' => 'text-green-600 bg-green-100',
        'danger' => 'text-red-600 bg-red-100',
        'warning' => 'text-yellow-600 bg-yellow-100',
        default => 'text-gray-600 bg-gray-100',
    };
@endphp

<span {{ $attributes->merge(['class' => "px-3 py-1 text-sm font-medium rounded-full $classes"]) }}>
    {{ $text }}
</span>
