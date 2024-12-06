@props([
    'name', 
    'label', 
    'value' => null, 
    'rows' => 4, 
    'placeholder' => '', 
    'required' => false, 
    'inputClass' => 'px-4 py-2 border rounded-md'  // Default class if not provided
])

<div class="mb-4">
    @if(isset($label))
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
            {{ $label }} @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif
    <textarea 
        name="{{ $name }}" 
        id="{{ $name }}" 
        rows="{{ $rows }}" 
        class="w-full {{ $inputClass }} bg-gray-50 p-3 border-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
    >{{ old($name, $value) }}</textarea>
    
    <!-- Error Message -->
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
