@props([
    'align' => 'center', // left, center, right
    'padding' => 'px-2 sm:px-4 py-2 sm:py-4', // Default padding
])

<td {{ $attributes->merge(['class' => "$padding text-$align text-xs sm:text-sm text-gray-700"]) }}>
    {{ $slot }}
</td>
