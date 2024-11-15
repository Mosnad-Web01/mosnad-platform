<div class="mb-4">
    <!-- Conditionally render label if provided -->
    @if (isset($label))
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif

    <div class="relative mt-3 mb-3">
        <!-- Input with icon -->
        @if (isset($icon))
            <span class="absolute inset-y-0 right-2 flex items-center pl-3 text-gray-500">
                <i class="{{ $icon }}"></i>
            </span>
        @endif

        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            id="{{ $name }}" 
            value="{{ old($name) }}" 
            class="w-full px-7 py-3 border border-gray-100 rounded-md bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $inputClass }}" 
            placeholder="{{ $placeholder }}" 
            {{ $attributes }} 
            autofocus
        >
        
       
    </div>

    <!-- Error Message -->
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>