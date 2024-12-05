<div class="mt-6 bg-white rounded-xl shadow-sm p-4 flex items-center justify-between">
    <div class="text-gray-500 text-sm">
        Showing
        <span class="font-medium">{{ $items->firstItem() }}</span>
        to
        <span class="font-medium">{{ $items->lastItem() }}</span>
        of
        <span class="font-medium">{{ $items->total() }}</span> results
    </div>
    <div class="flex gap-2">
        @if ($items->onFirstPage())
            <button disabled class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg transition-colors">
                Previous
            </button>
        @else
            <a href="{{ $items->previousPageUrl() }}" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                Previous
            </a>
        @endif

        @if ($items->hasMorePages())
            <a href="{{ $items->nextPageUrl() }}" class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">
                Next
            </a>
        @else
            <button disabled class="px-4 py-2 text-white bg-indigo-400 rounded-lg transition-colors">
                Next
            </button>
        @endif
    </div>
</div>