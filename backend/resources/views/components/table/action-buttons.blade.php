@props([
    'editUrl' => '#',
    'deleteUrl' => '#',
    'deleteConfirmMessage' => 'Are you sure you want to delete this item?',
    'hasDeleteButton' => false
])

<div {{ $attributes->merge(['class' => 'flex justify-center gap-2 items-center']) }}>

    @if ($hasDeleteButton)
        <!-- Delete Button -->
        <form action="{{ $deleteUrl }}" method="POST" onsubmit='return confirm("{{ $deleteConfirmMessage }}");'>
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:text-red-700 hover:scale-110 transition duration-300">
                <i class="material-icons">delete</i>
            </button>
        </form>
    @endif
    <!-- Edit Button -->
    <a href="{{ $editUrl }}" class="text-green-600 hover:text-green-800 hover:scale-110 transition duration-300">
        <i class="material-icons">edit</i>
    </a>
</div>
