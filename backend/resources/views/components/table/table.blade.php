<!-- /resources/views/components/table/table.blade.php -->
@props([
    'headers' => [],
    'hasActions' => false,
    'items' => null,
    'emptyStateMessage' => 'لا توجد بيانات',
    'withPagination' => true,
    'headerClass' => 'bg-gradient-to-r from-blue-600 to-blue-700',
    'dir' => 'rtl'
])

<div class="relative overflow-hidden rounded-xl shadow-lg bg-white" dir="{{ $dir }}">
    <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
        <table class="w-full">
            <thead>
            <tr class="{{ $headerClass }}">
                    @foreach($headers as $header)
                        <th class="px-4 sm:px-6 py-4 text-center text-sm font-bold text-white whitespace-nowrap">
                            {{ $header }}
                        </th>
                    @endforeach
                    @if($hasActions)
                        <th class="px-4 sm:px-6 py-4 text-center text-sm font-bold text-white whitespace-nowrap">
                            الإجراءات
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    @if($items?->isEmpty())
        <x-table.empty-state :message="$emptyStateMessage" />
    @endif

    @if($withPagination && $items)
        <div class="mt-4">
            <x-common.pagination :items="$items" />
        </div>
    @endif
</div>
