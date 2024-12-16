@props([
    'name',
    'label',
    'value' => null,
    'rows' => 4,
    'placeholder' => '',
    'required' => false,
    'inputClass' => 'px-4 py-2 border rounded-md', // Default class if not provided
    'icon' => null,
])

<div class="mb-2">

<div class="flex items-center gap-2">
        <!-- Conditionally render label if provided -->
        @if (isset($label))
            <!-- icon -->
            @if (isset($icon))
                <span class="">
                    <i class="{{ $icon }} w-4 h-4 text-indigo-600"></i>
                </span>
            @endif
            <label for="{{ $name }}" class="block text-lg font-bold text-gray-900">{{ $label }}
                @if($required) <span class="text-red-500">*</span>
                @endif
            </label>
        @endif

    </div>
    <div class="relative mt-3 mb-3">
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        class="w-full {{ $inputClass }} bg-gray-50  border-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
    >{{ old($name, $value) }}</textarea>
    </div>
    <!-- Error Message -->
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
