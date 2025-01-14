@props([
    'name', 
    'label', 
    'required' => false, 
    'inputClass' => 'px-4 py-2 border rounded-md', 
    'existingImage' => null, 
    'multiple' => false
])

<div class="mb-4">
    <!-- Conditionally render label if provided -->
    @if (isset($label))
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif

    <div class="relative mt-3 mb-3">
        <input 
            type="file" 
            name="{{ $name }}" 
            id="{{ $name }}" 
            class="w-full px-3 py-3 border border-gray-100 rounded-md bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $inputClass }}" 
            {{ $multiple ? 'multiple' : '' }}
        >
    </div>

    @if ($existingImage)
        <div class="mt-2">
            <p class="text-sm text-gray-600">Current Image:</p>
            <img src="{{ asset('storage/' . $existingImage) }}" alt="Current Image" class="mt-2 w-32 h-32 object-cover">
        </div>
    @endif

    <!-- Error Message -->
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
