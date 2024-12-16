<!-- backend/resources/views/dashboard/blogs/index.blade.php -->
<x-layout title="Manage Blogs">
    <!-- Search and Filter Section -->
    <div class="bg-white rounded-xl shadow-lg mb-6 p-6 " dir="ltr">
        <div class="flex flex-col lg:flex-row lg:justify-between gap-4">
            <!-- Search and Filters -->
            <div class="flex-1 flex flex-col md:flex-row gap-4">
                <!-- Search Input -->
                <div class="relative flex-1">
                    <input type="text" id="searchInput"
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-900 focus:ring-2 focus:ring-indigo-900/20 transition-all duration-300"
                        placeholder="Search blogs...">
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
                                <a href="#" class="block px-4 py-2 hover:bg-indigo-50 text-gray-700">Published</a>
                                <a href="#" class="block px-4 py-2 hover:bg-indigo-50 text-gray-700">Draft</a>
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
                                <a href="#" class="block px-4 py-2 hover:bg-indigo-50 text-gray-700">Newest
                                    First</a>
                                <a href="#" class="block px-4 py-2 hover:bg-indigo-50 text-gray-700">Oldest
                                    First</a>
                                <a href="#" class="block px-4 py-2 hover:bg-indigo-50 text-gray-700">Last Week</a>
                                <a href="#" class="block px-4 py-2 hover:bg-indigo-50 text-gray-700">Last Month</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Blog Button -->
            <div class="flex-shrink-0 text-center lg:text-right">
                <a href="{{ route('blogs.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-900 via-indigo-800 to-indigo-900
                              text-white rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5
                              transition-all duration-300">
                    <span class="material-icons w-5 h-5">search</span>

                </a>
            </div>
        </div>

        <!-- Active Filters -->
        <div class="flex flex-wrap gap-2 mt-4" id="activeFilters">
            <!-- Example Active Filter -->
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-indigo-50 text-indigo-900">
                Published
                <button class="ml-2 hover:text-indigo-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg px-4 md:px-2 py-4 ">
        <div class="mb-6 px-6 py-2">
            <!-- Add New Blog Button -->
            <a href="{{ route('blogs.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-900 via-indigo-800 to-indigo-900
                              text-white rounded-md shadow-lg hover:shadow-xl transform hover:-translate-y-0.5
                              transition-all duration-300">
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="font-normal">اضافة مدونة </span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-4 ">
            @foreach ($blogs as $blog)
                    <div
                        class="group relative flex flex-col overflow-hidden rounded-xl bg-gray-50 shadow-lg hover:shadow-2xl transition-all">
                        <!-- Card Header with Image -->
                        <div class="relative h-48 overflow-hidden">
                            @if($blog->images && json_decode($blog->images))
                                            @php
                                                $images = json_decode($blog->images);
                                                $imagePath = $images[0];
                                            @endphp

                                            @if(filter_var($imagePath, FILTER_VALIDATE_URL))
                                                <!-- If the image path is an external URL -->
                                                <img src="{{ $imagePath }}"
                                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                                    alt="{{ $blog->title }}">
                                            @else
                                                <!-- If the image path is a local file path -->
                                                <img src="{{ asset('storage/' . $imagePath) }}"
                                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                                    alt="{{ $blog->title }}">
                                            @endif
                            @else
                                <div class="w-full h-full bg-gradient-to-r from-purple-500 to-pink-500"></div>
                            @endif


                            <!-- Status Badge -->
                            <div class="absolute top-4 right-4">
                                <span
                                    class="px-3 py-1 text-xs font-semibold rounded-full
                                                        {{ $blog->status === 'published' ? 'bg-green-500' : 'bg-yellow-500' }} text-white">
                                    {{ ucfirst($blog->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-4 flex flex-col flex-grow">
                            <div class="flex items-center justify-between mb-4" dir="ltr">
                                <div class="flex items-center space-x-2">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-900 via-indigo-800 to-indigo-900
                                                                  flex items-center justify-center text-white shadow-lg ">
                                        <span class="font-semibold">{{ substr($blog->user->name, 0, 1) }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-indigo-900">{{ $blog->user->name }}</span>
                                        <span class="text-xs text-gray-500">{{ $blog->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                                <div
                                    class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center group-hover:bg-indigo-100 transition-colors">
                                    <svg class="w-4 h-4 text-indigo-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <h3 class="text-xl font-bold mb-2 text-gray-800 line-clamp-2">{{ $blog->title }}</h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($blog->content, 80) }}</p>

                            <!-- Tags -->
                            @if($blog->tags && json_decode($blog->tags))
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach(json_decode($blog->tags) as $tag)
                                        <span class="px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded-full">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <!-- Action Buttons -->
                            <div class="mt-auto pt-4 border-t border-gray-100" dir="ltr">
                                <div class="flex items-center justify-between">
                                    <!-- Conditional Action Buttons -->
                                    @can('update-blog', $blog)
                                        <x-table.action-buttons :editUrl="route('blogs.edit', $blog->id)"
                                            :deleteUrl="route('blogs.destroy', $blog->id)"
                                            deleteConfirmMessage="هل أنت متأكد من حذف هذه المدونة ؟" :hasDeleteButton="true" />
                                    @else
                                        <div></div> <!-- Empty div to maintain alignment -->
                                    @endcan

                                    <!-- Read More Link -->
                                    <a href="{{ route('blogs.show', $blog->id) }}"
                                        class="inline-flex items-center text-blue-500 hover:text-blue-600 transition-colors">
                                        Read More
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
        <div class="mt-4">
            <x-common.pagination :items="$blogs" />
        </div>

    </div>

    <!-- Your existing style and script tags -->
    <script>
        // Add this to your existing JavaScript
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');

            searchInput.addEventListener('input', function (e) {
                // Implement search functionality
                const searchTerm = e.target.value.toLowerCase();
                // Add your search logic here
            });

            // Add smooth hover effect for dropdowns
            const dropdowns = document.querySelectorAll('.group');
            dropdowns.forEach(dropdown => {
                const menu = dropdown.querySelector('.group-hover\\:block');

                dropdown.addEventListener('mouseenter', () => {
                    menu.style.display = 'block';
                    menu.style.opacity = '0';
                    menu.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        menu.style.transition = 'all 0.3s ease-out';
                        menu.style.opacity = '1';
                        menu.style.transform = 'translateY(0)';
                    }, 50);
                });

                dropdown.addEventListener('mouseleave', () => {
                    menu.style.opacity = '0';
                    menu.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        menu.style.display = 'none';
                    }, 300);
                });
            });
        });
    </script>
</x-layout>