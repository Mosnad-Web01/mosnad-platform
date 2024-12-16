@props([
    'name',
    'label',
    'options' => [],
    'value' => null,
    'placeholder' => '',
    'selectClass' => 'px-4 py-2 border rounded-md',
    'icon' => null,
    'required' => false
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
            <label for="{{ $name }}" class="blocktext-lg font-bold text-gray-900">{{ $label }}
                @if($required) <span class="text-red-500">*</span>
                @endif
            </label>
        @endif
    </div>

    <div class="relative mt-3 mb-3">
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            class="w-full px-3 py-3 border border-gray-100 rounded-md bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 {{ $selectClass }}"
            {{ $attributes }}
            @if($required) required @endif>

            <!-- Placeholder -->
            @if ($placeholder)
                <option value="" disabled selected>{{ $placeholder }}</option>
            @endif

            <!-- Options -->
            @foreach ($options as $optionValue => $optionLabel)
                <option class="text-black font-medium" value="{{ $optionValue }}" @if (old($name, $value) == $optionValue) selected @endif>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Error Message -->
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
