@props([
    'editUrl' => '#',
    'deleteUrl' => '#',
    'deleteConfirmMessage' => 'Are you sure you want to delete this item?',
    'hasDeleteButton' => false
])

<div {{ $attributes->merge(['class' => 'flex justify-center gap-2 items-center']) }}>
    @if ($hasDeleteButton)
        <!-- Delete Button -->
        <button
            type="button"
            data-delete-url="{{ $deleteUrl }}"
            data-delete-message="{{ $deleteConfirmMessage }}"
            class="delete-btn text-red-600 hover:text-red-700 hover:scale-110 transition duration-300">
            <i class="material-icons">delete</i>
        </button>
    @endif

    <!-- Edit Button -->
    <a href="{{ $editUrl }}" class="text-green-600 hover:text-green-800 hover:scale-110 transition duration-300">
        <i class="material-icons">edit</i>
    </a>
</div>
