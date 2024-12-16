<x-layout title="Activities">
    <x-common.header title="الأنشطة" :showBackButton="true" />

    <x-common.content-container title="جدول الأنشطة">
        <!-- Search and Filter Section -->
        <div class="bg-white rounded-2xl mb-812 p-6 ">
            <!-- Add New Activity Button -->
            <div class="flex-shrink-0 mb-10">
                <a href="{{ route('activities.create') }}"
                    class="inline-flex items-center px-6 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl shadow-lg hover:shadow-indigo-600/30 transform hover:-translate-y-0.5 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="font-medium">اضافة نشاط</span>
                </a>
            </div>
            <!-- Activities Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($activities as $activity)
                <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <!-- Activity Image -->
                    <div class="relative h-64 overflow-hidden">
                        @if ($activity->images && is_array($activity->images) && count($activity->images) > 0)
                        <img src="{{ Storage::url($activity->images[0]) }}" alt="Activity Image"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        @endif

                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="px-4 py-2 rounded-full text-sm font-medium
                            {{ $activity->status == 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $activity->status }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                <a href="{{ route('activities.show', $activity->id) }}"
                                    class="hover:text-indigo-600 transition-colors duration-300">
                                    {{ $activity->title }}
                                </a>
                            </h3>

                            <!-- Date and Location -->
                            <div class="space-y-2">
                                <div class="flex items-center text-gray-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-sm">
                                        {{ \Carbon\Carbon::parse($activity->activity_date)->format('F j, Y, g:i a') }}
                                    </span>
                                </div>

                                <div class="flex items-center text-gray-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-sm">{{ $activity->location ?? 'موقع غير محدد' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">


                            <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <x-table.cell>
                                    <x-table.action-buttons
                                        :editUrl="route('activities.edit', $activity->id)"
                                        :deleteUrl="route('activities.destroy', $activity->id)"
                                        deleteConfirmMessage="هل أنت متأكد من حذف هذا النشاط؟"
                                        :hasDeleteButton="true" />
                                </x-table.cell>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $activities->links() }}
            </div>
    </x-common.content-container>
</x-layout>