@props([
    'editUrl' => '#',
    'deleteUrl' => '#',
    'deleteConfirmMessage' => 'Are you sure you want to delete this item?',
    'hasDeleteButton' => false,
    'isBigButton' => false,
])

<div {{ $attributes->merge(['class' => 'flex justify-center gap-2 items-center']) }}>

    @if ($isBigButton)
        @if ($hasDeleteButton)
            <!-- Delete Button -->
            <button type="submit" data-delete-url="{{ $deleteUrl }}" data-delete-message="{{ $deleteConfirmMessage }}"
                class=" z-50 delete-btn flex items-center px-4 py-2 text-white bg-red-600  rounded-lg hover:bg-red-700 transition-colors duration-300">
                <i class="fas fa-trash-alt ml-2"></i>
                حذف
            </button>

        @endif

        <!-- Edit Button -->
        <a href="{{ $editUrl }}"
            class="z-50 flex items-center px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors duration-300">
            <i class="fas fa-edit ml-2"></i>
            تعديل
        </a>

    @else
        @if ($hasDeleteButton)
            <!-- Delete Button -->
            <button type="button" data-delete-url="{{ $deleteUrl }}" data-delete-message="{{ $deleteConfirmMessage }}"
                class="delete-btn text-red-600 hover:text-red-700 hover:scale-110 transition duration-300">
                <i class="material-icons">delete</i>
            </button>
        @endif

        <!-- Edit Button -->
        <a href="{{ $editUrl }}" class="text-green-600 hover:text-green-800 hover:scale-110 transition duration-300">
            <i class="material-icons">edit</i>
        </a>
    @endif
</div>