<x-layout title="Activities">
    <x-common.header title="الأنشطة" :showBackButton="true" />

    <x-common.content-container title="جدول الأنشطة">

     <!-- Search and Filter Section -->
     <div class="bg-white rounded-xl shadow-lg mb-6 p-6 " dir="ltr">
        <div class="flex flex-col lg:flex-row lg:justify-between gap-4">
            <!-- Search and Filters -->
            <div class="flex-1 flex flex-col md:flex-row gap-4">
                <!-- Search Input -->
                <div class="relative flex-1">
                    <input type="text" id="searchInput"
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-900 focus:ring-2 focus:ring-indigo-900/20 transition-all duration-300"
                        placeholder="Search activities...">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Filter Dropdowns -->
                <div class="flex flex-col md:flex-row gap-4 z-50">
                    <!-- Status Filter -->
                    <div class="relative group md:w-48">
                        <button
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-left flex items-center justify-between hover:border-indigo-900/50 transition-all duration-300">
                            <span class="text-gray-700">Status</span>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute z-50 w-full mt-2 hidden group-hover:block">
                            <div class="bg-white rounded-xl shadow-lg border border-gray-100 py-2">
                                <a href="#" class="block px-4 py-2 hover:bg-indigo-50 text-gray-700">All</a>
                                <a href="#" class="block px-4 py-2 hover:bg-indigo-50 text-gray-700">Active</a>
                                <a href="#" class="block px-4 py-2 hover:bg-indigo-50 text-gray-700">Inactive</a>
                            </div>
                        </div>
                    </div>

                    <!-- Date Filter -->
                    <div class="relative group md:w-48">
                        <button
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-left flex items-center justify-between hover:border-indigo-900/50 transition-all duration-300">
                            <span class="text-gray-700">Date</span>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute z-50 w-full mt-2 hidden group-hover:block">
                            <div class="bg-white rounded-xl shadow-lg border border-gray-100 py-2">
                                <a href="#" class="block px-4 py-2 hover:bg-indigo-50 text-gray-700">Newest First</a>
                                <a href="#" class="block px-4 py-2 hover:bg-indigo-50 text-gray-700">Oldest First</a>
                                <a href="#" class="block px-4 py-2 hover:bg-indigo-50 text-gray-700">Last Week</a>
                                <a href="#" class="block px-4 py-2 hover:bg-indigo-50 text-gray-700">Last Month</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Activity Button -->
            <div class="flex-shrink-0 text-center lg:text-right">
                <a href="{{ route('activities.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-900 via-indigo-800 to-indigo-900
                              text-white rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5
                              transition-all duration-300">
                    <span class="material-icons w-5 h-5">search</span>
                </a>
            </div>
        </div>

        <!-- Active Filters -->
        <div class="flex flex-wrap gap-2 mt-4" id="activeFilters">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-indigo-50 text-indigo-900">
                Active
                <button class="ml-2 hover:text-indigo-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg px-4 md:px-2 py-4">
        <div class="mb-6 px-6 py-2">
            <!-- Add New Activity Button -->
            <a href="{{ route('activities.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-900 via-indigo-800 to-indigo-900
                              text-white rounded-md shadow-lg hover:shadow-xl transform hover:-translate-y-0.5
                              transition-all duration-300">
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="font-normal">اضافة نشاط</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($activities as $activity)
                <div class="bg-white p-4 rounded-lg shadow-lg transition-all hover:scale-105">
                    <!-- Activity Image -->
                    @if ($activity->images && is_array(json_decode($activity->images)) && count(json_decode($activity->images)) > 0)
                    <img src="{{ Storage::url(json_decode($activity->images)[0]) }}" alt="Activity Image" class="w-full h-56 object-fit rounded-md mb-4">
                    @else
                        <div class="w-full h-48 bg-gray-200 rounded-md mb-4"></div> <!-- Placeholder if no image -->
                    @endif

                    <!-- Activity Title -->
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        <a href="{{ route('activities.show', $activity->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                            {{ $activity->title }}
                        </a>
                    </h3>

                    <!-- Activity Date -->
                    <p class="text-sm text-gray-500 mb-2">
                        {{ \Carbon\Carbon::parse($activity->activity_date)->format('F j, Y, g:i a') }}
                    </p>

                    <!-- Activity Location -->
                    <p class="text-sm text-gray-500 mb-4">
                        {{ $activity->location ?? 'موقع غير محدد' }}
                    </p>

                    <!-- Activity Status -->
                    <p class="text-sm text-gray-600 mb-4">
                        <span class="px-2 py-1 rounded-full text-white
                            {{ $activity->status == 'published' ? 'bg-green-500' : 'bg-yellow-500' }}">
                            {{ $activity->status }}
                        </span>
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center">
                        <x-table.action-buttons
                            :editUrl="route('activities.edit', $activity->id)"
                            :deleteUrl="route('activities.destroy', $activity->id)"
                            deleteConfirmMessage="هل أنت متأكد من حذف هذا النشاط؟"
                            :hasDeleteButton="true" />
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $activities->links() }}
        </div>
    </x-common.content-container>
</x-layout>
